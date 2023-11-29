# Intro_to_Database_Systems_Final_Project

## Pages
### Login
- [ ] user field
- [ ] password field
- [ ] login button - checks credentials against users in the database and redirects to home or incorrect password/user message
- [ ] register button/link - redirects to registration page

### Register
- [ ] user field - check against exsisting users in db
- [ ] password field
- [ ] cash to transfer (cheesy but that should be fine)
- [ ] submit button - automatically assign new id and creation date, adds new entry to 'accounts' in the db

### Home - Account
- [ ] Brows stocks link - redirects to stock list page
- [ ] displays cash amount
- [ ] table showing stocks and values
- [ ] \(Optional) expand to show each lot of this stock owned by user
- [ ] sell buttons for each stock - redirects to sell page or opens a sell form
- [ ] display total account value

### Stock List
- [ ] display list of all stocks (lol all 4 of them)
- [ ] ???search ( i don't think we need this,since we only have 4, but idk)
- [ ] link to each stock info page

### Stock Info - template
- [ ] buy button - redirects to buy page or opens a sell form
- [ ] stock name, price (could make up some company info, would need to add to the database)
- [ ] stock price history - put it in a graph if we can 

### Buy Form
- [ ] show the stock name/ticker and current price
- [ ] ammount to buy
- [ ] calculate and display the total cost
- [ ] confirm button - adds new stock lot to db, redirects to confirmation that then auto redirects after a few seconds back to home page
- [ ] error message if user doesn't have enough cash (could have button grayed out or something too)

### Sell form
- [ ] show stock name/ticker, current price and number of shares owned
- [ ] ammount to sell (could have form autofill with total amount)
- [ ] OR could have whole lots be selected, rather than number of shares, using checkboxes, might be easier so we can just delete a lot rather than update amounts of shares in the lot, idk
- [ ] calculate and display the total amount
- [ ] confirm button - add cash to user account, delete/update stock lot, redirect to confirmation/home page
- [ ] error message if number of shares entered is more than number owned
