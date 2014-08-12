<?php
if(isset($_GET["action"]) and $_GET["action"] == "add" and isset($_POST["node"]) and strlen($_POST["node"]) > 0){

$config = array(
    "digest_alg" => "sha512",
    "private_key_bits" => 4096,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
);
// Create the private and public key
$res = openssl_pkey_new($config);

// Extract the private key from $res to $privKey
openssl_pkey_export($res, $privKey);

// Extract the public key from $res to $pubKey
$pubKey = openssl_pkey_get_details($res);
$pubKey = $pubKey["key"];

        $uuid = UUID::v4();
        $stmt = $mysqli->prepare("insert into nodes(`name`, `owner`, `UUID`, `pri_key`, `pub_key`) values(?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $_POST["node"], $_SESSION["uid"], $uuid, $privKey, $pubKey);
        $stmt->execute();
        $stmt->close();
$_ALERTS['type'] = "success";
$_ALERTS['strong'] = "Success: ";
$_ALERTS['text'] = $_POST["node"] . " has been added!";
}elseif(isset($_GET["d"])){
        $stmt = $mysqli->prepare("delete from `nodes` where uuid=?");
        $stmt->bind_param("s", $_GET["d"]);
        $stmt->execute();
        $stmt->close();
}
echo "test";
?>

