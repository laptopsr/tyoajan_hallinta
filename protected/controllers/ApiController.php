<?php
	header("Access-Control-Allow-Origin: *");



//echo $_SERVER['HTTP_X_USERNAME'];
//var_dump($_GET);

class ApiController extends Controller
{
    // Members
    /**
     * Key which has to be in HTTP USERNAME and PASSWORD headers 
     */
    Const APPLICATION_ID = 'ASCCPE';
 
    /**
     * Default response format
     * either 'json' or 'xml'
     */
    private $format = 'json';
    /**
     * @return array action filters
     */
    public function filters()
    {
            return array();
    }
 


public function actionTiedosto($dom)

    {

    switch($_GET['model'])
    {
        case 'mob':

	  	if (!file_exists(Yii::app()->basePath."/../img/uploadedfromphone/".$dom)) {
		  	mkdir(Yii::app()->basePath."/../img/uploadedfromphone/".$dom, 0777, true);
		}


	   	$criteria = new CDbCriteria();
	    	$criteria->condition = "  
			salasana!='' 
			AND tekijan_email = '".$_POST['email']."' 
			AND salasana = '".$_POST['salasana']."' 
	    	";
            	$ttekija = Tyontekijat::model()->find($criteria);

	  	if(isset($ttekija->id)){

    	 	if (move_uploaded_file($_FILES['file']['tmp_name'], Yii::app()->basePath."/../img/uploadedfromphone/".$dom."/".$_POST['kohdenID']."_".$ttekija->id."_".date("YmdHi").".jpg")) 
		{


		$firma = FirmanTiedot::model()->findbypk(1);
		if(isset($firma->sahkoposti) and !empty($firma->sahkoposti))
		{
		$k = Kohteet::model()->findbypk($_POST['kohdenID']);
		$message = Yii::t('main', 'Hei. Valokuva on saapunut kohteista: ').$k->osoite;
		mail($firma->sahkoposti,Yii::t('main', 'Uusi valokuva kohteista. Lähettäjä: '). ' '.$ttekija->tekijan_nimi,$message);
		}

        	$this->_sendResponse(200, "saveOK");


    		} else {

        	$this->_sendResponse(200, "saveError");

    		}


	     	} else {

        	$this->_sendResponse(200, "Ei onnistu!");

	     	}


            break;
        default:
            // Model not implemented error
            $this->_sendResponse(501, sprintf(
                'Error: Mode <b>list</b> is not implemented for model <b>%s</b>',
                $_GET['model']) );
            Yii::app()->end();
    }
    // Did we get some results?
    if(empty($models)) {
        // No
        $this->_sendResponse(200, 
                sprintf('No items where found for model <b>%s</b>', $_GET['model']) );
    } else {
        // Prepare response
        $rows = array();
        foreach($models as $model)
            $rows[] = $model->attributes;
        // Send the response
        $this->_sendResponse(200, CJSON::encode($rows));
    }


}



public function actionTarkistaminen()
{

//$this->_checkAuth();

    switch($_GET['model'])
    {
        // Get an instance of the respective model
        case 'tags':

		$tt = Tyontekijat::model()->find(" tag_id='".$_POST['tag_id']."' ");

		$criteria=new CDbCriteria;
		$criteria->order = " id DESC ";
		$criteria->condition = " tag_id='".$_POST['tag_id']."' ";
		$tags = Tags::model()->find($criteria);

		if(!isset($tt->id))
		{
			$bd = '<h1>Työntekijä ei löyty!!!</h1>';
			$this->_sendResponse(200, CJSON::encode($bd));
			exit;
		}


		if(isset($tt->id) and 
			(!isset($tags->id) or (isset($tags->id) 
				and $tags->status != 1 and $tags->status != 2
			))
		)
		{
			$bd = '';
			$bd .= '<h1>Tervetuloa '.$tt->etunimi.' '.$tt->sukunimi.'</h1>';
			$bd .= '
			<center>
			<p>
			    <h2>ALOITUS</h2>
			    <p><button class="btn btn-lg btn-primary btn-block tyo">TYÖ</button></p>
			    <p><button class="btn btn-lg btn-primary btn-block lounastauko">LOUNASTAUKO</button></p>
			</p>
			</center>';
			$result = array(
				'tyontekija'=>$tt->id,
				'bd'=>$bd,
			);

			$this->_sendResponse(200, CJSON::encode($result));
			exit;
		}


		if(isset($tt->id) and 
			 (isset($tags->id) and $tags->status == 1)
		)
		{
			$bd = '';
			$bd .= '<h1>Tervetuloa '.$tt->etunimi.' '.$tt->sukunimi.'</h1>';
			$bd .= '
			<center>
			<p>
			    <h2>LOPETUS</h2>
			    <p><button class="btn btn-lg btn-warning btn-block tyolopetus" tags="'.$tags->id.'">TYÖ</button></p>
			</p>
			</center>';
			$result = array(
				'tyontekija'=>$tt->id,
				'bd'=>$bd,
			);

			$this->_sendResponse(200, CJSON::encode($result));
			exit;
		}

		if(isset($tt->id) and 
			 (isset($tags->id) and $tags->status == 2)
		)
		{
			$bd = '';
			$bd .= '<h1>Tervetuloa '.$tt->etunimi.' '.$tt->sukunimi.'</h1>';
			$bd .= '
			<center>
			<p>
			    <h2>LOPETUS</h2>
			    <p><button class="btn btn-lg btn-warning btn-block lounastaukolopetus" tags="'.$tags->id.'">LOUNASTAUKO</button></p>
			</p>
			</center>';
			$result = array(
				'tyontekija'=>$tt->id,
				'bd'=>$bd,
			);

			$this->_sendResponse(200, CJSON::encode($result));
			exit;
		}


            break;
        default:
            $this->_sendResponse(501, 
                sprintf('Mode <b>create</b> is not implemented for model <b>%s</b>',
                $_GET['model']) );
                Yii::app()->end();
    }

}




public function actionLuorivi()
{

//$this->_checkAuth();

    switch($_GET['model'])
    {
        // Get an instance of the respective model
        case 'tags':

		$tt = Tyontekijat::model()->findbypk($_POST['tyontekija']);

		if(!isset($tt->id))
		{
			$bd = '<h1>Työntekijä ei löyty!!!</h1>';
			$this->_sendResponse(200, CJSON::encode($bd));
			exit;
		}


		if(isset($tt->id))
		{

			$model = new Tags;
			$model->tid = $tt->id;
			$model->tag_id = $tt->tag_id;
			$model->etunimi = $tt->etunimi;
			$model->sukunimi = $tt->sukunimi;
			$model->aloitus = date("Y-m-d H:i:s");
			$model->status = $_POST['status'];
			if($model->save())
			{

				$bd = '';
				$bd .= '
				<center>
				<p>
				    <h1>'.$model->etunimi.' '.$model->sukunimi.'</h1><br>
				    <h3>Aloitus: '.date("d.m.Y H:i", strtotime($model->aloitus)).'</h3>
				</p>
				</center>';
	
				$this->_sendResponse(200, CJSON::encode($bd));
				exit;
			} else {
				$err = var_dump($model->getErrors());
				$this->_sendResponse(200, CJSON::encode($err));
				exit;
			}
		}

            break;
        default:
            $this->_sendResponse(501, 
                sprintf('Mode <b>create</b> is not implemented for model <b>%s</b>',
                $_GET['model']) );
                Yii::app()->end();
    }

}






public function actionSuljerivi()
{

//$this->_checkAuth();

    switch($_GET['model'])
    {
        // Get an instance of the respective model
        case 'tags':

		$tt = Tyontekijat::model()->findbypk($_POST['tyontekija']);
		$tags = Tags::model()->findbypk($_POST['tags']);

		if(!isset($tt->id))
		{
			$bd = '<h1>Työntekijä ei löyty!!!</h1>';
			$this->_sendResponse(200, CJSON::encode($bd));
			exit;
		}


		if(isset($tt->id) and isset($tags->id) and $tags->status == 1)
		{

			$lopetus = date("Y-m-d H:i:s");
			Tags::model()->updatebypk($tags->id, array('status'=>11, 'lopetus'=>$lopetus));
			$bd = '';
			$bd .= '
			<center>
			<p>
			    <h1>'.$tt->etunimi.' '.$tt->sukunimi.'</h1><br>
			    <h3>Työ lopetus: '.date("d.m.Y H:i", strtotime($lopetus)).'</h3>
			</p>
			</center>';

				$this->_sendResponse(200, CJSON::encode($bd));
				exit;
		}

		if(isset($tt->id) and isset($tags->id) and $tags->status == 2)
		{

			$lopetus = date("Y-m-d H:i:s");
			Tags::model()->updatebypk($tags->id, array('status'=>22, 'lopetus'=>$lopetus));
			$bd = '';
			$bd .= '
			<center>
			<p>
			    <h1>'.$tt->etunimi.' '.$tt->sukunimi.'</h1><br>
			    <h3>Lounastauko lopetus: '.date("d.m.Y H:i", strtotime($lopetus)).'</h3>
			</p>
			</center>';

				$this->_sendResponse(200, CJSON::encode($bd));
				exit;
		}

            break;
        default:
            $this->_sendResponse(501, 
                sprintf('Mode <b>create</b> is not implemented for model <b>%s</b>',
                $_GET['model']) );
                Yii::app()->end();
    }

}







private function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
{
    // set the status
    $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
    header($status_header);
    // and the content type
    header('Content-type: ' . $content_type);
 
    // pages with body are easy
    if($body != '')
    {
        // send the body
        echo $body;
    }
    // we need to create the body if none is passed
    else
    {
        // create some body messages
        $message = '';
 
        // this is purely optional, but makes the pages a little nicer to read
        // for your users.  Since you won't likely send a lot of different status codes,
        // this also shouldn't be too ponderous to maintain
        switch($status)
        {
            case 401:
                $message = 'You must be authorized to view this page.';
                break;
            case 404:
                $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                break;
            case 500:
                $message = 'The server encountered an error processing your request.';
                break;
            case 501:
                $message = 'The requested method is not implemented.';
                break;
        }
 
        // servers don't always have a signature turned on 
        // (this is an apache directive "ServerSignature On")
        $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];
 
        // this should be templated in a real-world solution

        $body = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
</head>
<body>
    <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
    <p>' . $message . '</p>
    <hr />
    <address>' . $signature . '</address>
</body>
</html>';
 
        echo $body;
    }
    Yii::app()->end();
}



private function _getStatusCodeMessage($status)
{
    // these could be stored in a .ini file and loaded
    // via parse_ini_file()... however, this will suffice
    // for an example
    $codes = Array(
        200 => 'OK',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        500 => 'Internal Server Error',

        501 => 'Not Implemented',
    );
    return (isset($codes[$status])) ? $codes[$status] : '';
}


private function _checkAuth()
{


    if(!(isset($_GET['X_USERNAME']) and isset($_GET['X_PASSWORD']))) {
        // Error: Unauthorized
        $this->_sendResponse(401);
    }
    $username = $_GET['X_USERNAME'];
    $password = $_GET['X_PASSWORD'];
    // Find the user
    $user=User::model()->find('LOWER(username)=?',array(strtolower($username)));
    if($user===null) {
        // Error: Unauthorized
        $this->_sendResponse(401, 'Error: User Name is invalid');
    } else if(!$user->validatePassword($password)) {
        // Error: Unauthorized
        $this->_sendResponse(401, 'Error: User Password is invalid');
    }

/*
    // Check if we have the USERNAME and PASSWORD HTTP headers set?
    if(!(isset($_SERVER['HTTP_X_USERNAME']) and isset($_SERVER['HTTP_X_PASSWORD']))) {
        // Error: Unauthorized
        $this->_sendResponse(401);
    }
    $username = $_SERVER['HTTP_X_USERNAME'];
    $password = $_SERVER['HTTP_X_PASSWORD'];
    // Find the user
    $user=User::model()->find('LOWER(username)=?',array(strtolower($username)));
    if($user===null) {
        // Error: Unauthorized
        $this->_sendResponse(401, 'Error: User Name is invalid');
    } else if(!$user->validatePassword($password)) {
        // Error: Unauthorized
        $this->_sendResponse(401, 'Error: User Password is invalid');
    }
*/
}


}

?>
