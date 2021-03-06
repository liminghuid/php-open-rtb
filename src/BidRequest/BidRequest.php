<?php
/**
 * BidRequest.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 28/08/15 - 11:39
 */

namespace PowerLinks\OpenRtb\BidRequest;

use PowerLinks\OpenRtb\BidRequest\Specification\BitType;
use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;
use PowerLinks\OpenRtb\Tools\Traits\SetterValidation;
use PowerLinks\OpenRtb\Tools\Traits\ToArray;
use PowerLinks\OpenRtb\Tools\Classes\ArrayCollection;

class BidRequest implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * @required
     * @var string
     */
    protected $id;

    /**
     * @required
     * @var ArrayCollection
     */
    protected $imp;

    /**
     * @recommended
     * @var Site
     */
    protected $site;

    /**
     * @recommended
     * @var App
     */
    protected $app;

    /**
     * @recommended
     * @var Device
     */
    protected $device;

    /**
     * @recommended
     * @var User
     */
    protected $user;

    /**
     * where 0 = live mode, 1 = test mode
     * @default 0
     * @var int
     */
    protected $test;

    /**
     * Auction type, where 1 = First Price, 2 = Second Price Plus
     * @default 2
     * @var int
     */
    protected $at;

    /**
     * Maximum time in milliseconds to submit a bid to avoid timeout
     * @var int
     */
    protected $tmax;

    /**
     * Array of strings
     * @var array
     */
    protected $wseat;

    /**
     * 0 = no or unknown, 1 = yes
     * @default 0
     * @var int
     */
    protected $allimps;

    /**
     * Array of strings (allowed currencies for bids on this bid request using ISO-4217 alpha codes)
     * @var array
     */
    protected $cur;

    /**
     * Array of strings
     * @var array
     */
    protected $bcat;

    /**
     * Array of strings
     * Block list of advertisers by their domains (e.g., “ford.com”)
     * @var array
     */
    protected $badv;

    /**
     * @var Regs
     */
    protected $regs;

    /**
     * @var Ext
     */
    protected $ext;

    public function __construct()
    {
        $this->initialize();
    }

    public function initialize()
    {
        $this->setImp(new ArrayCollection());
        $this->setSite(new Site());
        $this->setApp(new App());
        $this->setDevice(new Device());
        $this->setUser(new User());
        $this->setRegs(new Regs());
    }

    /**
     * @return string
     */
    public function getBidRequest()
    {
        return json_encode($this->toArray());
    }

    /**
     * @deprecated
     * @return string
     */
    public function getRequest()
    {
        return $this->getBidRequest();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setId($id)
    {
        $this->validateString($id);
        $this->id = $id;
        return $this;
    }

    /**
     * @param ArrayCollection $imp
     * @return ArrayCollection
     */
    public function setImp(ArrayCollection $imp)
    {
        $this->imp = $imp;
        return $this;
    }

    /**
     * @param Imp $imp
     * @return $this
     */
    public function addImp(Imp $imp = null)
    {
        if (is_null($imp)) {
            $imp = new Imp();
        }
        $this->imp->add($imp);
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getImp()
    {
        return $this->imp;
    }

    /**
     * @return Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param Site $site
     * @return $this
     */
    public function setSite(Site $site)
    {
        $this->site = $site;
        return $this;
    }

    /**
     * @return App
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param App $app
     * @return $this
     */
    public function setApp(App $app)
    {
        $this->app = $app;
        return $this;
    }

    /**
     * @return Device
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param Device $device
     * @return $this
     */
    public function setDevice(Device $device)
    {
        $this->device = $device;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Regs
     */
    public function getRegs()
    {
        return $this->regs;
    }

    /**
     * @param Regs $regs
     * @return $this
     */
    public function setRegs(Regs $regs)
    {
        $this->regs = $regs;
        return $this;
    }

    /**
     * @return int
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * @param $test
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setTest($test)
    {
        $this->validateIn($test, BitType::getAll());
        $this->test = $test;
        return $this;
    }

    /**
     * @return int
     */
    public function getAt()
    {
        return $this->at;
    }

    /**
     * @param int $at
     * @return $this
     */
    public function setAt($at)
    {
        $this->at = $this->validateInt($at);
        return $this;
    }

    /**
     * @return int
     */
    public function getTmax()
    {
        return $this->tmax;
    }

    /**
     * @param int $tmax
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setTmax($tmax)
    {
        $this->tmax = $this->validatePositiveInt($tmax);
        return $this;
    }

    /**
     * @return array
     */
    public function getWseat()
    {
        return $this->wseat;
    }

    /**
     * @param string $wseat
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addWseat($wseat)
    {
        $this->validateString($wseat);
        $this->wseat[] = $wseat;
        return $this;
    }

    /**
     * @param array $wseat
     * @return $this
     */
    public function setWseat(array $wseat)
    {
        $this->wseat = $wseat;
        return $this;
    }

    /**
     * @return int
     */
    public function getAllimps()
    {
        return $this->allimps;
    }

    /**
     * @param int $allimps
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setAllimps($allimps)
    {
        $this->validateIn($allimps, BitType::getAll());
        $this->allimps = $allimps;
        return $this;
    }

    /**
     * @return array
     */
    public function getCur()
    {
        return $this->cur;
    }

    /**
     * @param string $cur
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addCur($cur)
    {
        $this->validateString($cur);
        $this->cur[] = $cur;
        return $this;
    }

    /**
     * @param array $cur
     * @return $this
     */
    public function setCur(array $cur)
    {
        $this->cur = $cur;
        return $this;
    }

    /**
     * @return array
     */
    public function getBcat()
    {
        return $this->bcat;
    }

    /**
     * @param string $bcat
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addBcat($bcat)
    {
        $this->validateString($bcat);
        $this->bcat[] = $bcat;
        return $this;
    }

    /**
     * @param array $bcat
     * @return $this
     */
    public function setBcat(array $bcat)
    {
        $this->bcat = $bcat;
        return $this;
    }

    /**
     * @return array
     */
    public function getBadv()
    {
        return $this->badv;
    }

    /**
     * @param string $badv
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addBadv($badv)
    {
        $this->validateString($badv);
        $this->badv[] = $badv;
        return $this;
    }

    /**
     * @param array $badv
     * @return $this
     */
    public function setBadv(array $badv)
    {
        $this->badv = $badv;
        return $this;
    }

    /**
     * @return Ext
     */
    public function getExt()
    {
        return $this->ext;
    }

    /**
     * @param Ext $ext
     * @return $this
     */
    public function setExt(Ext $ext)
    {
        $this->ext = $ext;
        return $this;
    }
}