<?php


require_once(__DIR__.'/vendor/autoload.php');
Dotenv::load(__DIR__);

session_start();
$app = new \Slim\Slim(array(
        'templates.path' => './views'
    ));

$config = array(
    'client_id' => 'da936d28e357b526a6f5',
    'client_secret' => '55ba940bd306bc9f13fc57552c0e334e19f88c16',
    'redirect_url' => 'http://dyc.app:8000/github_login.php',
    'app_name' => 'DoYouComputer'
);

$loader = new Twig_Loader_Filesystem(__DIR__.'/views');
$twig = new Twig_Environment($loader);


$app->notFound(function () use($app)  {
        $app->redirect('/error');
    });


$name = (isset($_SESSION['name'])) ? $_SESSION['name'] : '';
$image = (isset($_SESSION['image'])) ? $_SESSION['image'] : '';

$twig->addGlobal('name', $name);
$twig->addGlobal('image', $image);
$twig->addGlobal('basedomain', 'http://dyc.app:8000');


//MISC PAGESx
$app->get('/', function () use ($twig) {
        echo $twig->render('index.php');
    });
$app->get('/lolwut', function() use($twig){
        echo $twig->render('lolwut.php');
    });

// SIGN UP RELATED STUFFS
$app->get('/signup', function() use($twig){
        echo $twig->render('signup.php');
    });

$app->get('/logout', function() use($twig){
        $_SESSION = [];
        header("Location: /");
    });

$app->get('/error', function() use($twig){
        echo $twig->render('404.php');
    });


$app->get('/auth', function() use($twig)
{
    $client_id = $_ENV['GH_CLIENT_ID'];
    $client_secret = $_ENV['GH_CLIENT_SECRET'];
    $redirect_url = $_ENV['GH_REDIRECT_URI'];

    if(isset($_GET['code']))
    {
        $code = $_GET['code'];

        $client = new \GuzzleHttp\Client();
        $r = $client->post('https://github.com/login/oauth/access_token',
            [
                'body' => [
                    'client_id' => $client_id,
                    'client_secret' => $client_secret,
                    'code' => $code
                ],
                "headers" => [
                    "Accept" => "application/json"]
            ])->json();

        $access_token = $r['access_token'];

        $user_data = $client->get("https://api.github.com/user?access_token=".$access_token)->json();
        $email = $user_data['email'];

        $conn = new PDO('mysql:dbname=doyoucomputer;host=localhost', $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD']);

        $query = 'SELECT * FROM users where email = "'.$email.'"';

        $find = $conn->prepare($query);
        $find->execute();
        if ($find->rowCount() == 0)
        {
            // query
            $sql = "INSERT INTO users (github_username, email, fullname, github_id, profile_image, profile_url)
                VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                    $user_data['login'],
                    $email,
                    $user_data['name'],
                    $user_data['id'],
                    $user_data['avatar_url'],
                    $user_data['url']
                ]);
        }

        $_SESSION['name'] = $user_data['name'];
        $_SESSION['image']   = $user_data['avatar_url'];
        $_SESSION['time']     = time();

        header("Location: /");
    }
    else
    {
        $url = "https://github.com/login/oauth/authorize?client_id=$client_id&redirect_uri=$redirect_url&scope=user";
        header("Location: $url");
    }
});

//CONTACT FORM STUFFS
$app->get('/contact', function() use($twig){
        echo $twig->render('contact.php');
    });

//USER RELATED STUFFS
$app->get('/challenges', function() use($twig){
        echo $twig->render('user/challenges.php');
    });


//CHALLENGE RELATED STUFFS
$app->get('/current', function() use($twig){
        echo $twig->render('challenges/current.php');
    });

$app->get('/submit', function() use($twig){
        echo $twig->render('challenges/submit.php');
    });

$app->get('/past', function() use($twig){
        echo $twig->render('challenges/past_list.php');
    });

$app->get('/past/:id', function($id) use($twig){
        echo $twig->render('challenges/past_single.php');
    });

$app->run();