<?php 
namespace Controller;

class CommandController extends Controller {
    protected $commandManager;
    protected $commandDetailManager;
    protected $productManager;

    public function showCommands() {
        $commands = $this->commandManager->getAll();
        $this->compact(["commands" => $commands]);
        $this->view("command");
    }
}