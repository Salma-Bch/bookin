    <?php
    use dao\DAOFactory;
    use model\Book;

    include_once('../../class/dao/DAOFactory.php');
    include_once('../../class/dao/object/BookDao.php');
    include_once('../../class/dao/object/BookDaoImpl.php');
    include_once('../../class/model/Book.php');
    include_once('../../class/dao/DAOUtility.php');
    include_once('../../class/dao/exception/DAOException.php');

    $filters = array();
    if ( isset($_POST['categories']) )
        $filters['categories'] = $_POST['categories'];

    if ( isset($_POST['agesRange']) )
        $filters['agesRange'] = $_POST['agesRange'];



    $daoFactory = DAOFactory::getInstance();
    $bookDao = $daoFactory->getBookDao();
    $books = $bookDao->getAll($filters);
    $booksArray = array();
    foreach ($books as $book){
        array_push($booksArray, $book->toArray());
    }
    echo json_encode($booksArray,JSON_INVALID_UTF8_SUBSTITUTE);
