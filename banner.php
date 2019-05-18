<?php
include_once 'src/Db.php';
$file = 'img/banner.png';

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: image/png');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);

    if (function_exists('fastcgi_finish_request')) {
        fastcgi_finish_request();
    }

    $db = Db::getInstance();

    $dbp = $db->prepare("INSERT INTO `history` (`ip_address`, `user_agent`, `page_url`, `views_count`) VALUES (:ip, :userAgent, :page, :viewCount) ON DUPLICATE KEY UPDATE views_count = views_count + 1");
    $dbp->bindValue(":ip", ip2long($_SERVER['REMOTE_ADDR']), PDO::PARAM_INT);
    $dbp->bindValue(":userAgent", $_SERVER['HTTP_USER_AGENT']);
    $dbp->bindValue(":page", $_SERVER['HTTP_REFERER']);
    $dbp->bindValue(":viewCount", 1, PDO::PARAM_INT);

    $dbp->execute();

    exit;
}
