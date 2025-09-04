<?php

class Messages extends Controller
{
    
    // private $messageModel;
    private $userModel;
    public function __construct()
    {
        if (!isLoggedIn()) {
            $this->redirect('auth/login');
        }

        $this->messageModel = $this->model('Message');
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $user_id = $_SESSION['user_id'];
        $conversations = $this->messageModel->getConversations($user_id);

        $data = [
            'conversations' => $conversations
        ];
        $this->view('messages/index', $data);
    }

    public function chat($participant_id)
    {
        $user_id = $_SESSION['user_id'];

        if ($user_id == $participant_id) {
            // Prevent user from chatting with themselves
            $this->redirect('messages');
        }

        $messages = $this->messageModel->getMessagesBetweenUsers($user_id, $participant_id);
        $participant = $this->userModel->getUserById($participant_id);

        if (!$participant) {
            $this->redirect('messages');
        }

        // Handle sending message
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $message_content = trim($_POST['message_content']);

            if (empty($message_content)) {
                // Handle error: empty message
                flash('chat_message', 'Vui lòng nhập nội dung tin nhắn', 'alert alert-danger');
                $this->redirect('messages/chat/' . $participant_id);
            }

            if ($this->messageModel->sendMessage($user_id, $participant_id, $message_content)) {
                $this->redirect('messages/chat/' . $participant_id); // Redirect to clear POST data
            } else {
                die('Có lỗi xảy ra khi gửi tin nhắn');
            }
        }

        $data = [
            'messages' => $messages,
            'participant' => $participant,
            'current_user_id' => $user_id
        ];
        $this->view('messages/chat', $data);
    }
}