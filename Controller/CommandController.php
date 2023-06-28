<?php 
namespace Controller;

class CommandController extends Controller {
    protected $commandManager;
    protected $commandDetailManager;
    protected $productManager;

    public function showCommands() {
        $commands = $this->commandManager->getByUser($_SESSION["user"]->id);
        $this->compact(["commands" => $commands]);
        $this->view("commands");
    }

    public function showCommand($id) {
        $command = $this->commandManager->getById($id);
        $command->products = $this->commandDetailManager->getProductsByCommandId($command->id);
        $this->compact(["command" => $command]);
        $this->view("command");
    }
}