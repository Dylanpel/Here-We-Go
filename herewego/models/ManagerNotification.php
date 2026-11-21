<?php
class ManagerNotification {

    public static function add($id_utilisateur, $message) {
        $db = Db::getInstance();
        $req = $db->prepare("INSERT INTO notification (id_utilisateur, message)
            VALUES (:id_utilisateur, :message)");
        return $req->execute([
            'id_utilisateur' => $id_utilisateur,
            'message'        => $message,
        ]);
    }

    public static function getByUtilisateur($id_utilisateur) {
        $db = Db::getInstance();
        $req = $db->prepare("SELECT * FROM notification 
            WHERE id_utilisateur = :id_utilisateur 
            ORDER BY date_creation DESC");
        $req->execute(['id_utilisateur' => $id_utilisateur]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function countUnread($id_utilisateur) {
        $db = Db::getInstance();
        $req = $db->prepare("SELECT COUNT(*) FROM notification 
            WHERE id_utilisateur = :id_utilisateur AND lu = 0");
        $req->execute(['id_utilisateur' => $id_utilisateur]);
        return $req->fetchColumn();
    }

    public static function markAllRead($id_utilisateur) {
        $db = Db::getInstance();
        $req = $db->prepare("UPDATE notification SET lu = 1 
            WHERE id_utilisateur = :id_utilisateur");
        return $req->execute(['id_utilisateur' => $id_utilisateur]);
    }

    public static function delete($id_notification) {
        $db = Db::getInstance();
        $req = $db->prepare("DELETE FROM notification WHERE id_notification = :id_notification");
        return $req->execute(['id_notification' => $id_notification]);
    }
}
?>