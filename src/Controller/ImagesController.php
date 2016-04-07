<?php
namespace App\Controller;

use App\Controller\AppController;
use ZipArchive;

/**
 * Images Controller
 *
 * @property \App\Model\Table\ImagesTable $Images
 */
class ImagesController extends AppController
{

    var $helpers = array('Html', 'Form','Csv'); 
    
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        
        if($this->request->is('post') && isset($this->request->data['name'])){
            $keyword = rawurlencode($this->request->data['name']);
            $query = "https://www.googleapis.com/customsearch/v1?key=AIzaSyBrlgJctzb0cGRoEIaUCuoOIOd2sFjco3I&cx=017117351499477805346:wnj1wqlsngk&searchType=image&num=10&startIndex=1&q=".$keyword;
            $json = $this->get_url_contents($query);
            $data = json_decode($json);
            if($data->searchInformation->totalResults > 0) {
                foreach ($data->items as $result) {
                    $image = $this->Images->newEntity();
                    $image->name = $result->snippet;
                    $image->link = $result->link;
                    $image->thumb_link = $result->image->thumbnailLink;
                    $this->Images->save($image);
                }
                $this->Flash->success(__('The image has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Image not found on google search.'));
            }
        }
        $this->paginate = [
            'order' => ['created' => 'desc'],
        ];
        $images = $this->paginate($this->Images);
        $this->set(compact('images'));
        $this->set('_serialize', ['images']);
    }

    /**
     * View method
     *
     * @param string|null $id Image id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $image = $this->Images->get($id, [
            'contain' => []
        ]);

        $this->set('image', $image);
        $this->set('_serialize', ['image']);
    }
    
    /**
     * generic method for create pdf
     */
    public function imagetopdf($id){
       $this->viewBuilder()->layout(false);
       $image = $this->Images->get($id, [
            'contain' => []
        ]);

        
        $this->RequestHandler->respondAs('pdf', [
            // Force download
            //'attachment' => true,
            'charset' => 'UTF-8'
        ]);
        $this->set('image', $image);
        
    }
    
    /**
     * generic method for create zip file
     */
    public function imagetozip($id){
        $this->viewBuilder()->layout(false);
        $image = $this->Images->get($id, [
            'contain' => []
        ]);
        $file = $image->link;
        $zip = new ZipArchive();
        $tmp_file = tempnam('.','');
        $zip->open($tmp_file, ZipArchive::CREATE);

        $download_file = file_get_contents($file);

        #add it to the zip
        $zip->addFromString(basename($file),$download_file);
        # close zip
        $zip->close();

        # send the file to the browser as a download
        header('Content-disposition: attachment; filename='.preg_replace("/[^a-zA-Z]+/", "-",$image->name).'.zip');
        header('Content-type: application/zip');
        readfile($tmp_file);

    }
    
    // Export file
    public  function export() {
        $this->viewBuilder()->layout(false);
        $images = $this->Images->find('all')->all()->toArray();
        // In a controller or table method.

        // Find all the articles.
        // At this point the query has not run.
        $query = $this->Images->find('all');
        $images = $query->toArray();
        $this->set(compact('images'));
        $this->set('_serialize', ['images']);
    }


    // get Google images
    function get_url_contents($url) {
        $crl = curl_init();

        curl_setopt($crl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
        curl_setopt($crl, CURLOPT_URL, $url);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, 5);

        $ret = curl_exec($crl);
        curl_close($crl);
        return $ret;
    }
}
