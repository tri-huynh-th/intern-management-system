<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo BASE_URL; ?>messages" class="btn btn-light"><i class="fa fa-backward"></i> Quay lại các cuộc hội thoại</a>
<br>
<h1>Trò chuyện với <?php echo $data['participant']['full_name']; ?></h1>

<div class="chat-box" style="border: 1px solid #ccc; padding: 10px; max-height: 400px; overflow-y: scroll;">
    <?php if (!empty($data['messages'])): ?>
        <?php foreach ($data['messages'] as $message): ?>
            <div class="message-item <?php echo ($message['sender_id'] == $data['current_user_id']) ? 'sent' : 'received'; ?>">
                <strong><?php echo ($message['sender_id'] == $data['current_user_id']) ? 'Bạn' : $message['sender_name']; ?>:</strong>
                <p><?php echo $message['message_content']; ?></p>
                <small><?php echo date('d/m/Y H:i', strtotime($message['sent_at'])); ?></small>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Chưa có tin nhắn nào trong cuộc hội thoại này.</p>
    <?php endif; ?>
</div>

<?php flash('chat_message'); ?>
<form action="<?php echo BASE_URL; ?>messages/chat/<?php echo $data['participant']['id']; ?>" method="post" class="mt-3">
    <div class="form-group">
        <textarea name="message_content" class="form-control form-control-lg" placeholder="Nhập tin nhắn..."></textarea>
    </div>
    <input type="submit" class="btn btn-primary" value="Gửi tin nhắn">
</form>

<?php require APPROOT . '/views/inc/footer.php'; ?>
