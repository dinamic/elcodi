#!/bin/bash
for i in $(ls -1 src/Elcodi/); do
    rm -rf elcodi.$i
    git clone git@github.com:elcodi/elcodi.git elcodi.$i;
    cd elcodi.$i;
    git filter-branch --prune-empty --subdirectory-filter src/Elcodi/$i;
    git remote rm origin
    git remote add origin git@github.com:elcodi/$i.git
    git push --force origin master
    git push --tags
    cd ..
    rm -rf elcodi.$i
done