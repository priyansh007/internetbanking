# D3 Simple - Population vs GDP per capita
The purpose of this homework is to teach you some basic grammar and functionalities contained in D3.js:

* Loading two datasets
* Performing DOM selection
* Filtering data attributes and sorting using one attribute
* Creating axes
* Adding a legend
* Using the D3 domain, range, and scale functions
* Adding axis labels
* Creating bar chart in circle
* Create two different charts with one X domain.

The starter codes for homework assignments uses D3 v7. You should use D3 v7 for your homeworks and project. If you are referencing online code tutorials, keep in mind that syntax may slightly change between versions! Be sure to also check the latest D3 documentation.




## Data and Chart Description

This assignment uses two csv files in the `Data/` folder: `gdp-per-capita-worldbank.csv` and `population-since-1800.csv`. Population CSV contains population of every countries from year 1800 to year 2021. GDP per capita csv contains country names and their gdp from year 2002 to year 2020. You will create circular bar chart graph for GDP per capita and population of most 50 populous country for year 2020.

## To start the assignment

* Clone this code to your local machine.
* Using a local server (such as HTTP Simple Server), open the **js/home.js** file. Remember, homeworks will be graded using Firefox and Python's HTTP Simple Server.
* Modify the source code according to the instructions below.
* Commit and push the code back to this repository to submit your assignment. The finished page in `index.html` should look like this:

![Completed Assignment](Images/Final_Graph.png)

## Assignment Steps

### Step 0: 
In the HTML file's `head` section, add your name and email.

### Step 1:
In the HTML file, there is a div with the id `my_dataviz`. Create an `svg` element inside this div. The `svg` should have a width of 1000 px and a height of 800 px.

> 🔍 **Note:** You can add the `svg` directly in the HTML or via Javascript in the `js/main.js` file.


### Step 2:
In `home.js`, `gdp-per-capita-worldbank.csv` and `population-since-1800.csv` files are loaded. Once the data is loaded,  store it in one or more global variables.

Since D3 doesn't have any information about the attribute types of the new files, it interprets every data value as a string. To use the quantatitive columns as such, you'll need to do some data wrangling to convert each row of the data to the correct numeric format. 
Create a array having json object with three variables - countryName, gdpPerCapita and population for year 2020. Sort Array using population and use top 50 countries for visualization.

### Step 3:
Next, create the x- and two y-axes for your chart. The x-axis will show country name, so we will use a `d3.scaleBand` for it. The first y-axis will show population of country, so we will use `d3.scaleRadial`. Second y-axis will show gdp per capita, it will also use `d3.scaleRadial`. Use innerCircle radius = 100 and outerCircle radius = 400. Use color of your choice for both plots.
 
 The first y-axis range will be 0 to maximum value of population, and the second y-axis range will be 0 to the maximum gdp per capita.

> 🔍 **Hint:** You'll need to use D3 `range` and `domain` to do this.

### Step 4:
Next, create the x- and two y-axes for your chart. The x-axis will show country name, so we will use a `d3.scaleBand` for it. The first y-axis will show population of country, so we will use `d3.scaleRadial`. Second y-axis will show gdp per capita, it will also use `d3.scaleRadial`. Use innerCircle radius = 100 and outerCircle radius = 400. Use color of your choice for both plots.
 
 The first y-axis range will be 0 to maximum value of population, and the second y-axis range will be 0 to the maximum gdp per capita.

> 🔍 **Hint:** You'll need to use D3 `range` and `domain` to do this.


### Step 5:
We want to visualize the relationship of male and female employement rates in selected country from 1991 to 2022, in order to observe how this relationship has changed over the time period of our dataset. For this we will create a [lollipop chart](https://datavizproject.com/data-type/lollipop-chart/). A lollipop chart is similar to a bar chart, but instead of using rectangles to show data values, it shows lines with circles at the top.

For each year in dataset, you should show two different colored lines, one for male and another for female. You can pick the colors you want to use, but they should be easily distinguishable. Append a circle at the top of each line for both male and female to create lollipop visualization.

> 🔍 **Hint:** Since your x-scale uses Javascript `Date` objects, you should convert your year values to Date objects to correctly call your x scale. You can do this operation here, or when you do your data wrangling in Step 3 (instead of converting to numerics, convert to `Date` objects).

> 🔍 **Hint:** You don't want the two lollipops for a year to overlap, so give them each a small amount of offset. In the image above, the male lollipop for each year is offset left 5 pixels, and the female lollipop is offset right 5 pixels.

> 🔍 **Hint:** Give a bit of margin around the outside of your chart so your objects don't run off the edge of the `svg`.


### Step 6:
It’s important to help your audience understand what is going on in the chart. To do this, add a legend at the upper right corner of the chart. The legend should have a square showing the colors, with labels reading "Female Employment Rate" and "Male Employment Rate". Then add titles for your x-axis and y-axis: "Year" for the x-axis and a rotated "Employment Rate" for the y-axis.

### Step 7:
As a final step, make the chart interactive. When the user updates the country value in the drop down, the chart should be redrawn to show the values for the newly selected country.

Once you are finished with Step 7 and you have your chart looking similar to the screenshot above, you are done! Be sure to commit and push your completed code by the deadline.

### Extra Credit:

Instead of simply redrawing the chart in Step 7 when a user selects a different country, use D3 transitions to animate each lollipop from the old to new values (that is, either growing or shrinking). This step is worth +2 extra credit points.

---

## Grading

This assignment is worth 10 points.
- (1 pt each) Steps 0, 1, 2, 3, 6, and 7
- (2 pts each) Steps 4 and 5
