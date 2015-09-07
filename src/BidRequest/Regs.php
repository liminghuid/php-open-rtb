<?php
/**
 * Regs.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 01/09/15 - 09:41
 */

namespace PowerLinks\OpenRtb\BidRequest;

use PowerLinks\OpenRtb\BidRequest\Interfaces\Arrayable;
use PowerLinks\OpenRtb\BidRequest\Specification\BitType;
use PowerLinks\OpenRtb\BidRequest\Validation\SetterValidation;
use PowerLinks\OpenRtb\BidRequest\Validation\ToArray;

class Regs implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * where 0 = no, 1 = yes
     * @var int
     */
    protected $coppa;

    /**
     * @var
     */
    protected $ext;

    /**
     * @return int
     */
    public function getCoppa()
    {
        return $this->coppa;
    }

    /**
     * @param int $coppa
     * @return $this
     * @throws Exception\ExceptionInvalidValue
     */
    public function setCoppa($coppa)
    {
        $this->validateIn($coppa, BitType::getAll(), __LINE__);
        $this->coppa = $coppa;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExt()
    {
        return $this->ext;
    }

    /**
     * @param $ext
     * @return $this
     */
    public function setExt($ext)
    {
        $this->ext = $ext;
        return $this;
    }


}