#!/usr/bin/env python
import numpy as np
import readData as rd
from sklearn.naive_bayes import GaussianNB
from sklearn.model_selection import train_test_split
from sklearn.metrics import classification_report
from sklearn.ensemble import RandomForestClassifier
import pandas as pd
import h5py as hd
import os
import shutil as sh
import pickle
from sklearn.model_selection import StratifiedKFold
from sklearn.model_selection import cross_validate

class MLAlgorithm(object):

    
    #constructor saves parameters and makes sure they aren't bad input
    def __init__(self,testname='test',subtestname = 'subtest',filenames=['breast'],features=['all'],test_train_split=.20,randomSplitState=10):
        self.testname = testname
        self.subtestname = subtestname
        self.df = []
        self.X = []
        self.yTrue = []
        self.yPred = [] 
        self.ts = test_train_split
        self.rs = randomSplitState
        self.test_train_split = test_train_split
        if self.test_train_split <= 0 or self.test_train_split >= 1:
            print('INVALID test/train split: '+str(test_train_split))
            self.f.write('INVALID test/train split: '+str(test_train_split))
            self.f.close()
            exit()
            
        self.path = os.getcwd()+'/'+'Results'+'/'+self.testname
        if os.path.exists(self.path):
            pass
        else:
            os.makedirs(self.path)
        self.path = self.path + '/' + self.subtestname + '/'
        if os.path.exists(self.path):
            sh.rmtree(self.path)
        os.makedirs(self.path)

        self.model = []
        
    def loadMatrixFromFile(self):
        self.X = pd.read_hdf('learningMatrix.h5')
        self.yTrue = pd.read_hdf('yTrue.h5')
        X_train, X_test, y_train, y_test = train_test_split(self.X, self.yTrue, test_size=self.ts, random_state=self.rs)
        self.X_train = X_train
        self.X_test = X_test
        self.y_train = y_train
        self.y_test = y_test
        return self.X,self.yTrue

    
    def crossValidate(self):
        kfold = StratifiedKFold(n_splits=3, shuffle=True, random_state=self.rs)
        results = cross_validate(self.model, self.X, self.yTrue, cv=kfold,scoring=['f1_macro','precision_macro','recall_macro'],return_train_score=False)
        return results
    
    def run(self):
        pass

    def getY_pred(self):
        return self.y_pred 

    def getY_test(self):
        return self.y_test

    def getPath(self):
        return self.path
    
    def saveModel(self):
        f= open(self.path + 'model.pkl',"wb")
        pickle.dump(self.model,f)

    
