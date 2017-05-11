<?php
if(!defined('URL_ADMIN_PART')){define('URL_ADMIN_PART', 'http://localhost/webbanhang/admin');}

//paging config
if(!defined('NUMBER_RECORD_IN_PAGE')){define('NUMBER_RECORD_IN_PAGE',3);}
if(!defined('NUMBER_RECORD_PRODUCTTYPE_IN_PAGE')){define('NUMBER_RECORD_PRODUCTTYPE_IN_PAGE',10);}
//Gender option
if(!defined('MALE')){define('MALE',1);}
if(!defined('FEMALE')){define('FEMALE',0);}

//Image upload load path
if(!defined('URL_ADMIN_UPLOAD_PART')){define('URL_ADMIN_UPLOAD_PART', $_SERVER['DOCUMENT_ROOT'].'/webbanhang/admin/uploads');}
if(!defined('URL_IMAGE_UPLOAD_PART')){define('URL_IMAGE_UPLOAD_PART', $_SERVER['DOCUMENT_ROOT'].'/webbanhang/uploads');}     /*http://localhost/webbanhang/uploads*/

//Default capquyen
if(!defined('DEFAULT_CAPQUYEN')){define('DEFAULT_CAPQUYEN',0);}

//User role
if(!defined('USER_STATUS_ACTIVE')){define('USER_STATUS_ACTIVE',1);}
if(!defined('USER_STATUS_UN_ACTIVE')){define('USER_STATUS_UN_ACTIVE',0);}

//url image path
if(!defined('URL_ADMIN_IMAGE_PART')){define('URL_ADMIN_IMAGE_PART', 'http://localhost/webbanhang/admin/uploads');}
if(!defined('URL_PRODUCT_IMAGE_PART')){define('URL_PRODUCT_IMAGE_PART', 'http://localhost/webbanhang/uploads');}
if(!defined('URL_TEMPLATE_PART')){define('URL_TEMPLATE_PART', 'http://localhost/webbanhang/webbanhangcongnghe');}

//url front end
if(!defined('URL_FRONT_END')){define('URL_FRONT_END', 'http://localhost/webbanhang');}

//Order status
if(!defined('ORDER_STATUS_ACTIVE')){define('ORDER_STATUS_ACTIVE',1);}
if(!defined('ORDER_STATUS_UN_ACTIVE')){define('ORDER_STATUS_UN_ACTIVE',0);}
