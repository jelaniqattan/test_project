<?php
/**
 * Created by PhpStorm.
 * User: jelani.qattan
 * Date: 19.09.2017
 * Time: 11:31
 */

namespace app\controllers;


use app\models\Country;
use app\models\UserModel;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;
class UserController extends Controller
{
    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest){
            $this->goHome();
        }
        $model = new UserModel();
        if($model->load(Yii::$app->request->post())&& $model->validate()){
            //$hash = Yii::$app->getSecurity()->generatePasswordHash($model->password);
            $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
            // $model->password die Wert wied verschlüssen
            $model->save(false);
            return $this->goHome();

        }
        $countryList = ArrayHelper::map(Country::find()->all(), 'id', 'name');
        //var_dump($countryList);die();
        return $this->render('register', array(
            'model' => $model,
            'countryList'=> $countryList,
        ));
    }
}