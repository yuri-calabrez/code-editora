<?php

namespace CodeEduUser\Menu;


class NavBar
{
    public function getLinksAuthorized($links)
    {
        $linksAuthorized = [];
        foreach ($links as $link) {
            if (isset($link[0])) {//menu dropdown
                $l = $this->getLinksAuthorized($link[1]);
                if (count($l)) {
                    $linksAuthorized[] = [$link[0], $l];
                }
            } else if (\Auth::user()->can($link['permission'])) {
                $linksAuthorized[] = $link;
            }
        }

        return $linksAuthorized;
    }
}