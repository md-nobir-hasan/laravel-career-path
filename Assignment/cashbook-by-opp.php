<?php

class CashBook
{
    private $dataFile = 'cashbook_data.json';
    private $categories = [
        'income' => ['Salary', 'Mutual Fund', 'Tuition'],
        'expense' => ['Food', 'Health', 'Cloth', 'Utilities'],
    ];
    private $income = [];
    private $expenses = [];

    public function __construct()
    {
        // Load data from the JSON file, if it exists
        if (file_exists($this->dataFile)) {
            $data = json_decode(file_get_contents($this->dataFile), true);
            if ($data) {
                $this->income = $data['income'] ?? [];
                $this->expenses = $data['expenses'] ?? [];
            }
        }
    }

    public function run()
    {

        while (true) {
            $this->displayMenu();
            $choice = readline("Choose an option (1-8): ");

            switch ($choice) {
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
                default:
                    echo "Invalid option. Please choose a valid option (1-8).\n";
                    break;
            }
        }
    }

    private function displayMenu()
    {
        echo "CashBook - Personal Finance Management\n";
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

    private function addIncome()
    {
        $amount = (int)readline('Amount: ');
        $this->displayCategories('income');
        $categoryIndex = (int)readline("Select an income category: ");

        if (isset($this->categories['income'][$categoryIndex - 1])) {
            $category = $this->categories['income'][$categoryIndex - 1];
            $this->income[] = ['amount' => $amount, 'category' => $category];
            echo "Income successfully added.\n";

            // Call saveData to save the updated data
            $this->saveData();
        } else {
            echo "Invalid income category selected.\n";
        }
    }

    private function addExpense()
    {
        $amount = (int)readline('Amount: ');
        $this->displayCategories('expense');
        $categoryIndex = (int)readline("Select an expense category: ");

        if (isset($this->categories['expense'][$categoryIndex - 1])) {
            $category = $this->categories['expense'][$categoryIndex - 1];
            $this->expenses[] = ['amount' => $amount, 'category' => $category];
            echo "Expense successfully added.\n";

            // Call saveData to save the updated data
            $this->saveData();
        } else {
            echo "Invalid expense category selected.\n";
        }
    }

    private function addCategory()
    {
        $categoryType = strtolower(readline('Enter category type (income/expense): '));
        $categoryName = readline('Enter category name: ');

        if (isset($this->categories[$categoryType])) {
            $this->categories[$categoryType][] = $categoryName;
            echo "Category successfully added.\n";

            // Call saveData to save the updated data
            $this->saveData();
        } else {
            echo "Invalid category type.\n";
        }
    }

    private function viewIncome()
    {
        $this->displayEntries('Income', $this->income);
    }

    private function viewExpenses()
    {
        $this->displayEntries('Expenses', $this->expenses);
    }

    private function viewCategories()
    {
        echo "Income Categories:\n";
        $this->displayCategories('income');
        echo "Expense Categories:\n";
        $this->displayCategories('expense');
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

    private function displayEntries($title, $entries)
    {
        echo "$title Entries:\n";
        foreach ($entries as $entry) {
            echo "Amount: {$entry['amount']}, Category: {$entry['category']}\n";
        }
    }

    private function displayCategories($categoryType)
    {
        $categories = $this->categories[$categoryType];
        foreach ($categories as $key => $category) {
            echo ($key + 1) . ". $category\n";
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

    private function saveData()
    {
        $data = [
            'income' => $this->income,
            'expenses' => $this->expenses,
            'categories' => $this->categories,
        ];
        file_put_contents($this->dataFile, json_encode($data, JSON_PRETTY_PRINT));
    }
}

$cashBook = new CashBook();
$cashBook->run();
