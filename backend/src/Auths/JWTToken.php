<?php
namespace App\Auths;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class JWTToken{
    private string $secretKey = "1s18ssassdjgbasubdjasdcsa";
    private string $role;
    private string $userId;

    
    public function __construct(){}
    public function generateToken(array $userData, $role): string{
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600; // jwt valid for 1 hour
        $payload = [
            'iat'       => $issuedAt,
            'exp'       => $expirationTime,
            'userId'    => $userData["id"],
            'email'     => $userData["email"],
            'phone'     => $userData["phone"],
            'name'      => $userData["name"],
            'lastname'  => $userData["lastname"],
            "role"      => $role,    
        ];
        return JWT::encode($payload, $this->secretKey, 'HS256');
    }
    public function decodeToken(string $token): array{
        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
            return (array)$decoded;
        } catch (\Exception $e) {
            return [];
        }
    }
    public function validateToken(string $token): bool{
        try {
            JWT::decode($token, new Key($this->secretKey, 'HS256'));
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function analiseToken(){
        $headers = getallheaders();

        if(isset($headers["Authorization"])){
            $token = str_replace("Bearer ", "", $headers["Authorization"]);
            $token = trim($token);
            $this->role = $this->decodeToken($token)["role"];   
            $this->userId = $this->decodeToken($token)["userId"];

            if($this->validateToken($token)){               
                return $this->decodeToken($token);
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


    public function checkedUserId(int $id): bool{
        if($this->userId == $id){
            return true;
        }else{
            return false;
        }
    }

}