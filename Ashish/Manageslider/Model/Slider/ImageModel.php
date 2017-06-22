<?php
/*
 * Created By: Ashish Ranade On : Jun 8, 2017 4:17:55 PM
 * Project: magento2-develop
 * File: File.php
 */
namespace Ashish\Manageslider\Model\Slider;

/**
 * Class ImageModel
 */
class ImageModel
{
    /**
     * storage database
     * @var \Magento\MediaStorage\Helper\File\Storage\Database
     */
    protected $_coreFileStorageDatabase;

    /**
     * image directory path
     * @var string
     */
    protected $_subDir = 'ashish/manageslider/slider';

    /**
     * Url interface
     * @var \Magento\Framework\UrlInterface
     */
    protected $_urlBuilder;

    /**
     * File system object
     * @var \Magento\Framework\Filesystem
     */
    protected $_fileSystem;

    /**
     * logger
     * @var \Psr\Log\LoggerInterface
     */
    protected $_logger;

    /**
     * upload factory
     * @var \Magento\MediaStorage\Model\File\UploaderFactory
     */
    private $_uploaderFactory;

    /**
     * storage interface
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * Constructor
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param \Magento\Framework\Filesystem $fileSystem
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\MediaStorage\Helper\File\Storage\Database $coreFileStorageDatabase
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory
     */
    public function __construct(
    \Magento\Framework\UrlInterface $urlBuilder,
            \Magento\Framework\Filesystem $fileSystem,
            \Psr\Log\LoggerInterface $logger,
            \Magento\MediaStorage\Helper\File\Storage\Database $coreFileStorageDatabase,
            \Magento\Store\Model\StoreManagerInterface $storeManager,
            \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory
    )
    {
        $this->_coreFileStorageDatabase = $coreFileStorageDatabase;
        $this->_logger = $logger;
        $this->_uploaderFactory = $uploaderFactory;
        $this->_urlBuilder = $urlBuilder;
        $this->_storeManager = $storeManager;
        $this->_fileSystem = $fileSystem;
    }

    /**
     * Get site url
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->_urlBuilder->getBaseUrl(
                        ['_type' => UrlInterface::URL_TYPE_MEDIA]) . $this->_subDir . '/image';
    }

    /**
     * Get directory path
     * @return string
     */
    public function getBaseDir()
    {
        return $this->_fileSystem->getDirectoryWrite(
                                \Magento\Framework\App\Filesystem\DirectoryList::MEDIA)
                        ->getAbsolutePath($this->_subDir . '/image');
    }

    /**
     * get base temp directory path
     * @return string
     */
    public function getBaseTempDir()
    {
        return $this->_subDir . '/image';
    }

    /**
     * Get file path
     * @param $path
     * @param $imageName
     * @return type
     */
    public function getFilePath($path, $imageName)
    {
        return rtrim($path, '/') . '/' . ltrim($imageName, '/');
    }

    /**
     * Save file
     * @param $fileId
     * @return type
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function saveFileToTmpDir($fileId)
    {
        $baseTmpPath = $this->getBaseTempDir();
        $uploader = $this->_uploaderFactory->create(['fileId' => $fileId]);
        $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png', 'zip', 'doc']);
        $uploader->setAllowRenameFiles(true);

        $result = $uploader->save($this->getBaseDir());

        if (!$result) {
            throw new \Magento\Framework\Exception\LocalizedException(
            __('File can not be saved to the destination folder.')
            );
        }

        /**
         * Workaround for proto1.7 methods "isJSON", "evalJSON" on Windows OS
         */
        $result['tmp_name'] = str_replace('\\', '/', $result['tmp_name']);
        $result['path'] = str_replace('\\', '/', $result['path']);
        $result['url'] = $this->_storeManager
                        ->getStore()
                        ->getBaseUrl(
                                \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                        ) . $this->getFilePath($baseTmpPath, $result['file']);
        $result['name'] = $result['file'];

        if (isset($result['file'])) {
            try {
                $relativePath = rtrim($baseTmpPath, '/') . '/' . ltrim($result['file'],
                                '/');
                $this->_coreFileStorageDatabase->saveFile($relativePath);
            } catch (\Exception $e) {
                $this->_logger->critical($e);
                throw new \Magento\Framework\Exception\LocalizedException(
                __('Something went wrong while saving the file(s).')
                );
            }
        }

        return $result;
    }

}