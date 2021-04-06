<?php
include_once('./class/dao/DAOFactory.php');
include_once('./class/dao/DAOUtility.php');
include_once('./class/dao/exception/DAOException.php');

include_once('./class/dao/object/BookDao.php');
include_once('./class/dao/object/BookDaoImpl.php');
include_once('./class/model/Book.php');

include_once('./class/dao/object/ClientDao.php');
include_once('./class/dao/object/ClientDaoImpl.php');
include_once('./class/model/Client.php');

include_once('./class/dao/object/AdministratorDao.php');
include_once('./class/dao/object/AdministratorDaoImpl.php');
include_once('./class/model/Administrator.php');

include_once('./class/dao/object/PurchaseDao.php');
include_once('./class/dao/object/PurchaseDaoImpl.php');
include_once('./class/model/Purchase.php');

include_once('./class/dao/object/EvaluatesDao.php');
include_once('./class/dao/object/EvaluatesDaoImpl.php');
include_once('./class/model/Evaluates.php');

include_once('./class/dao/object/LikesDao.php');
include_once('./class/dao/object/LikesDaoImpl.php');
include_once('./class/model/Likes.php');

include_once('./class/dao/object/TagDao.php');
include_once('./class/dao/object/TagDaoImpl.php');
include_once('./class/model/Tag.php');

include_once('./class/controller/Suggestion.php');
include_once('./class/controller/ContentModel.php');
include_once('./class/controller/ClientHandler.php');

include_once('./class/controller/algorithm/PopularAlgorithm.php');
include_once('./class/controller/algorithm/RandomAlgorithm.php');
include_once('./class/controller/algorithm/UserAlgorithm.php');
include_once('./class/controller/algorithm/ContentAlgorithm.php');

include_once('./class/utility/Format.php');
include_once('./class/Utility/Math.php');