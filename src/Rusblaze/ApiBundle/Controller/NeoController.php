<?php
/**
 * Created by PhpStorm.
 * User: aivanov
 * Date: 29.08.17
 * Time: 13:24
 */

namespace Rusblaze\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Rusblaze\CoreDomain\Neo\NeoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Rusblaze\CoreDomain\Neo\Neo;

class NeoController extends Controller
{
    /**
     * @Rest\View
     *
     * @param NeoRepository $repo
     *
     * @return Neo[]
     */
    public function hazardousAction(NeoRepository $repo)
    {
        return $repo->getHazardous();
    }

    /**
     * @Rest\View
     *
     * @param Request       $request
     * @param NeoRepository $repo
     *
     * @return null|Neo
     */
    public function fastestAction(Request $request, NeoRepository $repo)
    {
        $hazardous = $request->query->get('hazardous', 'false');
        switch ($hazardous) {
            case 'true':
                $hazardous = true;
                break;
            default:
                $hazardous = false;
                break;
        }

        return $repo->getFastest($hazardous);
    }

    /**
     * @Rest\View
     *
     * @param Request       $request
     * @param NeoRepository $repo
     *
     * @return array
     */
    public function bestYearAction(Request $request, NeoRepository $repo)
    {
        $hazardous = $request->query->get('hazardous', 'false');
        switch ($hazardous) {
            case 'true':
                $hazardous = true;
                break;
            default:
                $hazardous = false;
                break;
        }

        if (!is_null($year = $repo->getBestYear($hazardous))) {
            return ['year' => $year];
        }
    }

    /**
     * @Rest\View
     *
     * @param Request       $request
     * @param NeoRepository $repo
     *
     * @return array
     */
    public function bestMonthAction(Request $request, NeoRepository $repo)
    {
        $hazardous = $request->query->get('hazardous', 'false');
        switch ($hazardous) {
            case 'true':
                $hazardous = true;
                break;
            default:
                $hazardous = false;
                break;
        }

        if (!is_null($month = $repo->getBestMonth($hazardous))) {
            return ['month' => $month];
        }
    }
}