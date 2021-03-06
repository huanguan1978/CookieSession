<?php
/**
 * @title            Config Class
 *
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2016, Pierre-Henry Soria. All Rights Reserved.
 * @license          GNU General Public License 3 or later <http://www.gnu.org/licenses/gpl.html>
 * @package          PH7 / CookieSession
 */
declare(strict_types=1);

namespace PH7\CookieSession;

abstract class Config implements IConfig
{
    private $iExpiration = 31536000; // 1 Year
    private $sPrefix = 'pH7Cookie_';
    private $sPath = '/';
    private $sDomain;
    private $bIsSsl;


    public function getExpiration() : int
    {
        return $this->iExpiration;
    }

    public function getPrefix() : string
    {
        return $this->sPrefix;
    }

    public function getPath() : string
    {
        return $this->sPath;
    }

    public function getDomain() : string
    {
        if (empty($this->sDomain)) {
            $sDomain = (($_SERVER['SERVER_PORT'] != '80') && ($_SERVER['SERVER_PORT'] != '443')) ?  $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_NAME'];
            $this->sDomain = '.' . str_replace('www.', '', $sDomain);
        }
        return $this->sDomain;
    }

    public function getIsSsl() : bool
    {
        if (empty($this->bIsSsl)) {
            $this->bIsSsl = (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on');
        }
        return $this->bIsSsl;
    }


    /**
     * @param int $iExpiration In seconds.
     */
    public function setExpiration(int $iExpiration)
    {
        $this->iExpiration = $iExpiration;
    }

    /**
     * @param string $sPrefix Prefix for the Cookie name.
     */
    public function setPrefix(string $sPrefix)
    {
        $this->sPrefix = $sPrefix;
    }

    /**
     * @param string $sPath Full Path (e.g., /path/to/app/).
     */
    public function setPath(string $sPath)
    {
        return $this->sPath = $sPath;
    }

    /**
     * @param string $sPath Domain name (e.g., mysite.com).
     */
    public function setDomain(string $sDomain)
    {
        $this->sDomain = $sDomain;
    }

    /**
     * @param bool $bIsSsl
     */
    public function setIsSsl(bool $bIsSsl)
    {
        $this->bIsSsl = $bIsSsl;
    }
}
