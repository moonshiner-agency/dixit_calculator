# dixit_calculator

A simple script that calculates dixit points (boardgames)

It was created during a game of dixit very late.

## How to use it

add the result per round in an excel that is called `dixit.csv`

The csv needs the format:

```csv
round,correct,color,card,selected
1,6,white,9,7
1,6,pink,11,3
1,6,lime,6
1,6,blue,5,6
1,6,black,3
1,6,blue,1,6
1,6,green,2,11
1,6,grey,10,
1,6,red,4,9
1,6,orange,7
1,6,yellow,8,3
```

by running `php calc.php` the total points will be shown.
