<?php 
namespace Controller;

class CommandController extends Controller {
    protected $commandManager;
    protected $commandDetailManager;
    protected $productManager;
    protected $rateManager;

    public function showCommands() {
        $commands = [];

        switch($_SESSION["user"]->role) {
            case "seller":
                $products = $this->productManager->getAllBySeller($_SESSION["user"]->id);
                foreach($products as $product) {
                    $product->total = 0;
                    $product->quantity = 0;
                    $commands[$product->id] = $this->commandManager->getCommandsByProductId($product->id);

                    foreach($commands[$product->id] as $command) {
                        $command->rate = $this->rateManager->getProductCurrentRate($product->id, $command->user_id);

                        if($command->rate !== false) {
                            $command->rate = $command->rate->rating;
                        }

                        $command->total = $command->quantity * $product->price;
                        $product->total += $command->total;
                        $product->quantity += $command->quantity;
                    }
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

        foreach($command->products as $product) {
            $product->rate = $this->rateManager->getProductCurrentRate($product->id, $command->user_id);

            if($product->rate !== false) {
                $product->rate = $product->rate->rating;
            }
        }

        $this->compact(["command" => $command]);
        $this->view("command");
    }
}