<?php

class CashBook
{
    private $data_file = "cashbook_data.json";
    private $categories = [
        'income' => ['Salary', 'Mutual Fund', 'Tuition'],
        'expense' => ['Food', 'Health', 'Cloth', 'Utilities'],
    ];
    private $income = [];
    private $expenses = [];


    public function __construct()
    {
       if(file_exists($this->data_file)){
            $data = json_decode(file_get_contents($this->data_file), true);
           if($data){
                $this->categories = $data['categories'] ?? $this->categories;
                $this->income = $data['income'] ?? [];
                $this->expenses = $data['expenses'] ?? [];
           }
       }
    }

    public function run()
    {

        $asciiArt = <<<EOT
                    _________               .__   ___.                  __    
                    \_   ___ \_____    _____|  |__\_ |__   ____   ____ |  | __
                    /    \  \/\__  \  /  ___/  |  \| __ \ /  _ \ /  _ \|  |/ /
                    \     \____/ __ \_\___ \|   Y  \ \_\ (  <_> |  <_> )    < 
                    \______  (____  /____  >___|  /___  /\____/ \____/|__|_ \
                            \/     \/     \/     \/    \/                   \/                                       
                EOT;

        echo $asciiArt;
        while(true){
            $this->displayMenus();
            $opt = readline('Choose an option (1-8): ');
            switch ($opt) {
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
        
            echo "\n";
        }
    }

    private function AddIncome()
    {
        $amount = (int) readline('Enter amount: ');
        $this->displayCategories('income');
        $cat = (int) readline('Choose an option for Category: ');
        $catgry = $this->categories['income'][$cat];
        $this->income[] = [$amount, $catgry];
        echo "Income added successfully \n";
        $this->saveData();
    }

    private function addExpense()
    {
        $amount = (int) readline('Enter amount: ');
        $this->displayCategories('expense');
        $cat = (int) readline('Choose an option for Category: ');
        $catgry = $this->categories['expense'][$cat];
        $this->expenses[] = [$amount, $catgry];
        echo "Expense added successfully \n";
        $this->saveData();
    }

    private function addCategory()
    {
        $i = 1;
        echo "Select an Category: \n";
         foreach($this->categories as $key =>$item){
            echo ($i).". $key \n";
            $i++;
         }
        $cat_item = (int) readline('Choose an option: ');
        $catgry = $cat_item==1 ? "income" : "expense";

        $cat_name = readline('Enter a Category name: ');
        array_push($this->categories[$catgry], $cat_name);
        echo "Category added successfully \n";
        $this->saveData();
    }

    private function viewIncome()
    {
        $this->displayEntries("Income",$this->income);
    }

    private function viewExpenses()
    {
        $this->displayEntries("Expense", $this->expenses);
    }

    private function viewCategories()
    {
        $this->displayCategories();
    }

    private function viewTotal()
    {
        $totalIncome = $this->calculateTotal($this->income);
        $totalExpenses = $this->calculateTotal($this->expenses);
        echo "Total Income: $totalIncome\n";
        echo "Total Expenses: $totalExpenses\n";
    }

    private function viewSavings()
    {
        $totalIncome = $this->calculateTotal($this->income);
        $totalExpenses = $this->calculateTotal($this->expenses);
        $savings = $totalIncome - $totalExpenses;
        echo "Your Savings: $savings\n";
    }

    private function displayMenus()
    {
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

    private function displayCategories($key=null)
    {
      
       if($key){
            echo "Select a Category:\n";
            foreach ($this->categories[$key] as $catkey => $cat) {
                echo ($catkey + 1) . " $cat \n";
            }
       }else{
            foreach ($this->categories as $catkey => $cat) {
                echo "$catkey Categories are: \n";
                foreach($cat as $key =>$c){
                    echo ($key+1)." $c \n";
                }
            }
       }
    }

    public function saveData()
    {
        $data = [
            "categories" => $this->categories,
            "income" => $this->income,
            "expenses" => $this->expenses,
        ];
        $datatojson = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($this->data_file, $datatojson);
    }

    public function displayEntries($title,$entries){
        echo "$title entries:\n";
        foreach($entries as $key => $entry){
            echo "Amount: {$entry[0]}, Category: {$entry[1]}\n";
        }
    }

    private function calculateTotal($entries)
    {
        $total = 0;
        foreach ($entries as $entry) {
            $total += $entry['amount'];
        }
        return $total;
    }
}

$cashbook = new CashBook();
$cashbook->run();
