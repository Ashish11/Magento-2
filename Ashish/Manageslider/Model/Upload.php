<?php
/*
 * Created By: Ashish Ranade On : Jun 9, 2017 4:06:43 PM
 * Project: magento2-develop
 * File: Upload.php
 */
namespace Ashish\Manageslider\Model;

/**
 * Class Upload
 */
class Upload
{
    /**
     * Upload factory
     * @var \Magento\MediaStorage\Model\File\UploaderFactory
     */
    protected $_uploaderFactory;

    /**
     * Constructor
     * @param \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory
     */
    public function __construct(
    \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory
    )
    {
        $this->_uploaderFactory = $uploaderFactory;
    }

    /**
     * Upload file and return name
     * @param $input
     * @param $destinationFolder
     * @param $data
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function uploadFileAndGetName($input, $destinationFolder, $data)
    {
        try {
            if (isset($data[$input]['delete'])) {
                return '';
            } else {
                $uploader = $this->_uploaderFactory->create(['fileId' => $input]);
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(true);
                $uploader->setAllowCreateFolders(true);
                $result = $uploader->save($destinationFolder);
                return $result['file'];
            }
        } catch (Exception $e) {
            if ($e->getCode() != \Magento\Framework\File\Uploader::TMP_NAME_EMPTY) {
                throw new \Magento\Framework\Exception\LocalizedException($e->getMessage());
            } else if (isset($data[$input]['value'])) {
                return $data[$input]['value'];
            }
        }

        return '';
    }

}