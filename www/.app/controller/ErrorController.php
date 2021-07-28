<?php
//@ Assign =================================
// + Setting
Meta::vprefix(".err");

// + Hierarcy
//PageInfo::push_title("エラー", null);
//@=========================================

class ErrorController extends IErrorController{
    public function index(){
        $this->setModel(404);
        Response::setStatusCode(404); 
        return;
    }
    public function code($ex, $statusCode){
        if($ex instanceof UnauthorizedhException){
            //return Response::redirect("/auth/?r=". base64_encode(Request::getUrl()));
            Response::setStatusCode(404);
            $this->setModel(404);
            return;
        }
        $this->setModel($statusCode);
        return;
    }
    
    private function setModel($statusCode){
        switch ($statusCode){
            case 400:
                Model::set("em1", "Bad Request.");
                Model::set("em1", __("error.".$statusCode.""));
                Model::set("em2", __("error.".$statusCode."-msg"));
                break;
            case 401:
                Model::set("em1", "Authentication required.");
                Model::set("em1", __("error.".$statusCode.""));
                Model::set("em2", __("error.".$statusCode."-msg"));
                break;
            case 403:
                Model::set("em1", __("error.".$statusCode.""));
                Model::set("em2", __("error.".$statusCode."-msg"));
                break;
            case 404:
                Model::set("em1", __("error.".$statusCode.""));
                Model::set("em2", __("error.".$statusCode."-msg"));
                break;
            case 500:
                Model::set("em1", __("error.".$statusCode.""));
                Model::set("em2", __("error.".$statusCode."-msg"));
                break;
            case 501:
                Model::set("em1", __("error.".$statusCode.""));
                Model::set("em2", __("error.".$statusCode."-msg"));
                break;
            default:
                Model::set("em1", __("error.default"));
                Model::set("em2", __("error.default-msg"));
                break;
        }
        Model::set("code", $statusCode);
        Meta::breadcrumb($statusCode, null);
    }
}