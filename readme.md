# 博大精深PHP!!!

- 获取类方法不能这样 $peo->$say()，也不能这样$peo.say()，要这样$peo->say()
- 动态获取类、方法 比如说
    ```
    $name = 'SaleDetail';
    $sale = new $name(); // 咋不上天呢？
    ```
