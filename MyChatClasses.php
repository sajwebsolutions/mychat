<?php

    /*
        This Code is written for Test Assessment.
        Job Applied On: UpWork

        Developer Name: M Sajid Bhatti
        UpWork Profile: https://www.upwork.com/freelancers/~01231f9a3653acd96c

        As mentioned in the instructions, I focused more on quality, and I have tried
        to make it error free and according to the requirements.
    */


//DB Connection - Demo
class Database {

    private $host = 'localhost';
    private $username = 'username';
    private $password = 'password';
    private $database = 'database';
    private $conn;


    //Construct
    public function __construct()
    {
        $this->conn     =       new mysqli($this->host, $this->username, $this->password, $this->database);


        //Connection
        if (mysqli_connect_error())
        {
            die('Connection Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
        }
    }


    //Get Connection
    public function getConnection()
    {
        return $this->conn;
    }
}


// User class
class User
{
    //User Properties
    protected $id;
    protected $firstName;
    protected $lastName;
    protected $email;
    protected $profilePhoto;
    protected $salutation;



    //Constructor - Assigned the required values as created
    public function __construct($id, $firstName, $lastName, $email, $profilePhoto = null, $salutation = null)
    {
        $this->id           =   $id;
        $this->firstName    =   $firstName;
        $this->lastName     =   $lastName;
        $this->email        =   $email;
        $this->profilePhoto =   $profilePhoto;
        $this->salutation   =   $salutation;
    }


    //Functions

    //Full name
    public function getFullName()
    {
        if ($this->salutation)
        {
            return $this->salutation . ' ' . $this->firstName . ' ' . $this->lastName;
        }
        else
        {
            return $this->firstName . ' ' . $this->lastName;
        }
    }


    //Get Profile Pic
    public function getProfilePicture()
    {
        if ($this->profilePhoto)
        {
            return $this->profilePhoto;
        }
        else
        {
            return 'default.jpg'; //Default avatar - need to place the pic in folder
        }
    }


    //Get Email
    public function getEmail()
    {
        return $this->email;
    }


    //Get user ID
    public function getUserId()
    {
        return $this->id;
    }


    //Save User
    public function saveUser()
    {
        //Validation
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {
            return false;
        }

        //.jpg allowed
        if ($this->profilePhoto && !preg_match('/\.jpg$/', $this->profilePhoto))
        {
            return false;
        }

        //Saved Successfully
        return true;
    }
}


//Message Class
class Message {
    private $sender;
    private $receiver;
    private $text;
    private $creationTime;
    private $type;

    public function __construct(User $sender, User $receiver, $text, $type)
    {
        $this->sender       =   $sender;
        $this->receiver     =   $receiver;
        $this->text         =   $text;
        $this->type         =   $type;
        $this->creationTime =   time();
    }


    //Sender Name
    public function getSenderName()
    {
        return $this->sender->getFullName();
    }


    //Receiver Name
    public function getReceiverName()
    {
        return $this->receiver->getFullName();
    }


    //Text
    public function getText()
    {
        return $this->text;
    }


    //Type
    public function getType()
    {
        return $this->type;
    }


    //Formatted Date
    public function getFormattedCreationTime()
    {
        return date('Y-m-d H:i:s', $this->creationTime);
    }


    //Save
    public function save()
    {
        //Validation
        if (!$this->sender instanceof Teacher || !$this->receiver instanceof Student)
        {
            return false;
        }

        //Validate Message Type
        if ($this->type !== 'Manual')
        {
            return false;
        }

        //Saved
        return true;
    }
}

