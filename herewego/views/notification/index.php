<h2>Mes notifications</h2>

<?php if(empty($notifications)) { ?>
    <p>Aucune notification.</p>
<?php } else { ?>
    <?php foreach($notifications as $notif) { ?>
        <div>
            <p><?php echo $notif['message']; ?></p>
            <small><?php echo $notif['date_creation']; ?></small>
        </div>
    <?php } ?>
<?php } ?>