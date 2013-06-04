<?php
/**
* A user controller  to manage login and view edit the user profile.
* 
* @package QcmfCore
*/
class CCUser extends CObject implements IController {

  private $userModel;
  

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct();
    $this->userModel = new CMUser();
  }


  /**
   * Show profile information of the user.
   */
  public function Index() {
    $this->views->SetTitle('User Profile');
    $this->views->AddInclude(__DIR__ . '/index.tpl.php', array(
      'is_authenticated'=>$this->userModel->IsAuthenticated(), 
      'user'=>$this->userModel->GetProfile(),
    ));
  }
  
   /**
   * Authenticate and login a user.
   */
  public function Login() {
    $form = new CFormUserLogin($this);
    $form->CheckIfSubmitted();
	
	var_dump($this->views);
	 
	
    $this->views->SetTitle('Login');
	$this->views->AddInclude(__DIR__ . '/login.tpl.php', array('login_form'=>$form->GetHTML()));
	 /*
                ->AddInclude(__DIR__ . '/login.tpl.php', array('login_form'=>$form->GetHTML()));
	 */     
  }

  /**
   * Perform a login of the user as callback on a submitted form.
   */
  public function DoLogin($form) {
    if($this->user->Login($form['acronym']['value'], $form['password']['value'])) {
      $this->session->AddMessage('success', "Welcome {$this->user['name']}.");
      $this->RedirectToController('profile');
    } else {
      $this->session->AddMessage('notice', "Failed to login, user does not exist or password does not match.");
      $this->RedirectToController('login');      
    }
  }

  /**
   * Logout a user.
   */
  public function Logout() {
    $this->userModel->Logout();
    $this->RedirectToController();
  }
  
  /**
   * View and edit user profile.
   */
  public function Profile() {    
    $form = new CFormUserProfile($this, $this->user);
    $form->CheckIfSubmitted();

    $this->views->SetTitle('User Profile');
    $this->views->AddInclude(__DIR__ . '/profile.tpl.php', array(
                  'is_authenticated'=>$this->user['isAuthenticated'], 
                  'user'=>$this->user,
                  'profile_form'=>$form->GetHTML(),
                ));
  }

  /**
   * Change the password.
   */
  public function DoChangePassword($form) {
    if($form['password']['value'] != $form['password1']['value'] || empty($form['password']['value']) || empty($form['password1']['value'])) {
      $this->AddMessage('error', 'Password does not match or is empty.');
    } else {
      $ret = $this->user->ChangePassword($form['password']['value']);
      $this->session->AddMessage($ret, 'Saved new password.', 'Failed updating password.');
    }
    $this->RedirectToController('profile');
  }

  /**
   * Save updates to profile information.
   */
  public function DoProfileSave($form) {
    $this->user['name'] = $form['name']['value'];
    $this->user['email'] = $form['email']['value'];
    $ret = $this->user->Save();
    $this->session->AddMessage($ret, 'Saved profile.', 'Failed saving profile.');
    $this->RedirectToController('profile');
  }

  /**
   * Init the user database.
   */
  public function Init() {
    $this->userModel->Init();
    $this->RedirectToController();
  }
  

}