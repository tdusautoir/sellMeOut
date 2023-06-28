<?php 
namespace Controller;

class CommandController extends Controller {
    protected $commandManager;
    protected $commandDetailManager;
    protected $productManager;

    public function showCommands() {
        $commands = [];

        switch($_SESSION["user"]->role) {
            case "seller":
                $products = $this->productManager->getAllBySeller($_SESSION["user"]->id);
                foreach($products as $product) {
                    $commands[$product->id] = $this->commandManager->getCommandsByProductId($product->id);
                }

                $this->compact(["products" => $products]);
                break;
            case "buyer":
                $commands = $this->commandManager->getByUser($_SESSION["user"]->id);
                break;
            default:
                $commands = $this->commandManager->getAll();
                break;
        }

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