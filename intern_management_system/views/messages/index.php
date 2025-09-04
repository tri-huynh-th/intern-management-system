<?php require APPROOT . '/views/inc/header.php'; ?>
<h1>Tin nhắn</h1>
<p>Các cuộc hội thoại của bạn:</p>
<?php if (!empty($data['conversations'])): ?>
    <ul class="list-group">
        <?php foreach ($data['conversations'] as $conversation): ?>
            <li class="list-group-item">
                <a href="<?php echo BASE_URL; ?>messages/chat/<?php echo $conversation['participant_id']; ?>">
                    <?php echo $conversation['participant_name'] . ' (' . $conversation['participant_email'] . ')'; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Bạn chưa có cuộc hội thoại nào.</p>
<?php endif; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>
