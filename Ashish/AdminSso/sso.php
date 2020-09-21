<?php

class encryptData
{
    /**
     * @var string $string
     */
    private $string;
    /**
     * @var string $method
     */
    private $method;
    /**
     * @var string encryption IV
     */
    private $enctyptionIv;
    /**
     * @var string encryption key
     */
    private $encryptionKey;

    /**
     * constant
     */
    const OPTION = 0;

    /**
     * encryptData constructor.
     *
     * @param $string
     * @param $method
     * @param $Iv
     * @param $encryptionKey
     */
    public function __construct($string, $method, $Iv, $encryptionKey)
    {
        $this->string = $string;
        $this->method = $method;
        $this->enctyptionIv = $Iv;
        $this->encryptionKey = $encryptionKey;
    }

    /**
     * encrypt string
     *
     * @return false|string
     */
    public function encrypt()
    {
        $encryption = openssl_encrypt(
            $this->string,
            $this->method,
            $this->encryptionKey, self::OPTION, $this->enctyptionIv);
        return $encryption;
    }

    /**
     * redirect to url
     *
     * @param $url
     */
    public function redirect($url)
    {
        header($url);
        exit;
    }
}
$simple_string = json_encode(array('username' => 'admin'));
$ciphering = "AES-128-CTR";
$encryption_iv = '1234567891011121';
$encryption_key = "asolutionscoin";
$obj = new encryptData($simple_string, $ciphering, $encryption_iv, $encryption_key);
$encryptVal = $obj->encrypt();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin SSO Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Login to Admin Panel</h2>
    <form action="http://ashishranade-local/index.php/sso/integration/adminsso" method="get">
        <input type="hidden" name="encryptedString" value="<?php echo $encryptVal;?>">
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div>
</body>
</html>
