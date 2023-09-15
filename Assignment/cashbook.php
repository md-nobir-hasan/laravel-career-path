<?php

class CashBook{
    private $categories = [
        'income' => ['Salary', 'Mutual Fund', 'Tuition'],
        'expense' => ['Food', 'Health', 'Cloth', 'Utilities'],
    ];
    private $income = [];
    private $expenses = [];
    public function run(){
        $this->displayMenus();
        $opt = readline('Choose an option (1-8): ');
        switch($opt){
            case 1:
                $this->addIncome();
                break;
            case 2:
                $this->addExpense();
                break;
            case 3:
                $this->addCategory();
                break;
            case 4:
                $this->viewIncome();
                break;
            case 5:
                $this->viewExpenses();
                break;
            case 6:
                $this->viewCategories();
                break;
            case 7:
                $this->viewTotal();
                break;
            case 8:
                $this->viewSavings();
                break;
        }
    }

    private function AddIncome(){
        $amount = (int) readline('Enter amount: ');
        $this->displayCategories('income');
        $cat = (int) readline('Choose an option for Category: ');
        $catgry = $this->categories['income'][$cat];
        $this->income[] = [$amount,$catgry];

        $this->saveData();
    }
    private function addExpense(){

    }
    private function addCategory(){

    }
    private function viewIncome(){

    }
    private function viewExpenses(){

    }
    private function viewCategories(){

    }
    private function viewTotal(){

    }

    private function viewSavings(){

    }

    private function displayMenus(){
        echo "\nCashBook - Personal Finance Management\n";
        echo "Select an option:\n";
        echo "1. Add Income\n";
        echo "2. Add Expense\n";
        echo "3. Add Category\n";
        echo "4. View Income\n";
        echo "5. View Expenses\n";
        echo "6. View Categories\n";
        echo "7. View Total\n";
        echo "8. View Savings\n";
    }
    private function displayCategories($key){
        echo "Select a Category:\n";
       foreach($this->categories[$key] as $catkey => $cat){
            echo ($catkey + 1)." $cat \n";
       }
    }

    public function saveData(){
        $data = [
            "categories" => $this->categories,
            "income" => $this->income,
            "expenses" => $this->expenses,
        ];
        json_encode()
    }
}

$cashbook = new CashBook();
$cashbook->run();