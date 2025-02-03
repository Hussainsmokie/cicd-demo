# CICD DEMO - FIRST STEP INITIALIZING GIT REPO FROM LOCAL TO GITHUB

#STEP 1:

First we have collected the frontend and backend files from the developers

#STEP 2:

We have tried to connect to github through our local terminal using the below mentioned commands and adding to it we have also installed GIT

sudo apt install git - Downloading Git on our local device

git --version - To verify if the GIT has been installed successfully

git config --global user.name "Hussainsmokie" - This command is used to configure username 

git config --global user.email "nousath1609@gmail.com" - This is used to authenticate email address for github

#For password authentication this feature has been outdated or not supported by GIT from 2021, so we have to authenticate our user using generating Token 

For token we have to use Token autherization for that use this path,

Settings -> Developer Settings -> Personal access tokens -> Tokens(Classic) then generate token and give timestamp for renewal of token.

STEP 3:

Initialise git in the local source code directory
Move to sorce code path 

cd /path/to/your/source code/directory

Initialise git in this directory now

git init

After initialising, to add all files 

git add .

I we want to add only one or two files, give the names of the files

git add file1 file2

After adding sorce code files, we have to make the commits to see the commits made (at a later time for reference -bexample : what changes have been made in the file)

git commit -m "my first commit"

Step 4:

We need to connect to github and push code

Copy remore github repo URL 

git remote add origin <url of github repo>

git remote -v

Now we need to push the code into the remote git repository (In our case it is in github)

check the branch

git branch -M

git push -u origin main

#Incase If a problem arises to push source code files into the remote repo main branch but we are unavle to push, then we need to use the rebase command to do it.

1) First we need to pull - git pull https://github.com/Hussainsmokie/cicd-demo.git
 
2) Then we need to rebase - git pull origin main --rebase
 
3) Now we try to push it back into remote repo - git push -u origin main


