<?php

class Message
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getConversations($user_id)
    {
        $this->db->query('SELECT DISTINCT
                                CASE
                                    WHEN m.sender_id = :user_id THEN m.receiver_id
                                    ELSE m.sender_id
                                END as participant_id,
                                u.full_name as participant_name,
                                u.email as participant_email
                            FROM messages m
                            JOIN users u ON (
                                (m.sender_id = :user_id AND u.id = m.receiver_id) OR
                                (m.receiver_id = :user_id AND u.id = m.sender_id)
                            )
                            WHERE m.sender_id = :user_id OR m.receiver_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }

    public function getMessagesBetweenUsers($user1_id, $user2_id)
    {
        $this->db->query('SELECT messages.*, sender_users.full_name as sender_name, receiver_users.full_name as receiver_name FROM messages JOIN users as sender_users ON messages.sender_id = sender_users.id JOIN users as receiver_users ON messages.receiver_id = receiver_users.id WHERE (sender_id = :user1_id AND receiver_id = :user2_id) OR (sender_id = :user2_id AND receiver_id = :user1_id) ORDER BY sent_at ASC');
        $this->db->bind(':user1_id', $user1_id);
        $this->db->bind(':user2_id', $user2_id);
        return $this->db->resultSet();
    }

    public function sendMessage($sender_id, $receiver_id, $message_content)
    {
        $this->db->query('INSERT INTO messages (sender_id, receiver_id, message_content) VALUES (:sender_id, :receiver_id, :message_content)');
        $this->db->bind(':sender_id', $sender_id);
        $this->db->bind(':receiver_id', $receiver_id);
        $this->db->bind(':message_content', $message_content);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
