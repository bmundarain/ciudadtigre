<?php
namespace CiudadTigre\AnuncianteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SitemapsController extends Controller
{

    /**
     * @Route("/sitemap.{_format}", name="sample_sitemaps_sitemap", Requirements={"_format" = "xml"})
     * @Template("AcmeSampleStoreBundle:Sitemaps:sitemap.xml.twig")
     */
    public function sitemapAction() 
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $urls = array();
        $hostname = $this->getRequest()->getHost();

        // add some urls homepage
        $urls[] = array('loc' => $this->get('router')->generate('home'), 'changefreq' => 'weekly', 'priority' => '1.0');

        // multi-lang pages
        foreach($languages as $lang) {
            $urls[] = array('loc' => $this->get('router')->generate('home_contact', array('_locale' => $lang)), 'changefreq' => 'monthly', 'priority' => '0.3');
        }
        
        // urls from database
        $urls[] = array('loc' => $this->get('router')->generate('home_product_overview', array('_locale' => 'en')), 'changefreq' => 'weekly', 'priority' => '0.7');
        // service
        foreach ($em->getRepository('CiudadTigreAnuncianteBundle:Anunciante')->findAll() as $product) {
            $urls[] = array('loc' => $this->get('router')->generate('home_product_detail', 
                    array('productSlug' => $product->getSlug())), 'priority' => '0.5');
        }

        return array('urls' => $urls, 'hostname' => $hostname);
    }
}