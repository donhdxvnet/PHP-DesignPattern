<?php
 
abstract class Logger
{
    private $_next = null;
    public function setNext(Logger $logger)
    {
        $this->_next = $logger;
        return $this->_next;
    }
    public function log($message)
    {
        $this->_log($message);
        if ($this->_next !== null) {
            $this->_next->log($message);
        }
    }
    abstract protected function _log($message);
}
class EmailLogger extends Logger
{
    public function _log($message)
    {
        echo "Sending via email: ", $message, " \n<br>";
    }
}
class ErrorLogger extends Logger
{
    protected function _log($message)
    {
        echo "Sending to stderr: ", $message, " \n<br>";
    }
}
class StdoutLogger extends Logger
{
    protected function _log($message)
    {
        echo "Writing to stdout: ", $message, " \n<br>";
    }
}
 
 
/**
 * Usage
 */
$logger = new StdoutLogger();
$logger->setNext(new ErrorLogger())->setNext(new EmailLogger());
$logger->log('Something happened');
 
// Output:
// Writing to stdout: Something happened
// Sending to stderr: Something happened
// Sending via email: Something happened