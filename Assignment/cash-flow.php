<?php
$cat =  [
    'income' => ['Salary', 'Mutual Fund', 'Tuition'],
    'expense' => ['Food', 'Health', 'Cloth', 'Utilities'],
];
$income = [];
$expense = [];

function add(&$change, $cat = null)
{
    // if($cat){
    $amount = (int) readline('Amount: ');
    $inc_cat = "";
    foreach ($cat as $key => $val) {
        $inc_cat .= ($key + 1) . ". $val \n";
    }
    $cat_opt = (int) (readline("Which Category ?\n$inc_cat Choose an option: "));
    $cat = $cat[$cat_opt - 1];
    array_push($change, [$amount, $cat]);

    // }else{

    // }


}

function sum($arr): int
{
    $sum = 0;
    foreach ($arr as $item) {
        $sum += (int)($item[0]);
    }
    return $sum;
}

$addIncome = function () //1
{
    global $cat, $income;
    add($income, $cat['income']);
    return "Income successfully added\n";
};

$addExp = function () //2
{
    global $cat, $expense;
    add($expense, $cat['expense']);
    return "Expense successfully added\n";
};

$addCat = function () //3
{
    global $cat;
    $cat_name = (int) readline('Category Name: ');
    array_push($cat, $cat_name);
    return "Category successfully added\n";
};

$sumIncome = function () //4
{
    global $income;
    $sum = sum($income);
    return "your total income: " . $sum . "\n";
};

$sumExp = function () //5
{
    global $expense;
    $sum = sum($expense);
    return "your total expense: " . $sum . "\n";
};

$viewCat = function () //6
{
    global $cat;
    $inc_cat = "";
    foreach ($cat as $k => $item) {
        $inc_cat .= "$k categories are: \n";
        foreach ($item as $key => $val)
            $inc_cat .= ($key + 1) . ". $val \n";
    }
    return $inc_cat;
};

$total = function () //7
{
    global $income, $expense;
    $income = sum($income);
    $expense = sum($expense);
    return "Total income: $income\nTotal expense: $expense\n";
};

$saving = function () //8
{
    global $income, $expense;
    $total = sum($income) - sum($expense);
    return "Your savings: " . $total . "\n";
};


$cash_book = [
    $addIncome,
    $addExp,
    $addCat,
    $sumIncome,
    $sumExp,
    $viewCat,
    $total,
    $saving,
];

while (true) {
    $opt = readline("Select an option:
                1. Add Income
                2. Add Expense
                3. Add Category
                4. View Income
                5. View Expense
                6. View Category
                7. View Total
                8. View Savings
                Choose an option (1-8): ");
    printf("\n");
    printf(($cash_book[($opt - 1)]()));
    printf("\n");
}
