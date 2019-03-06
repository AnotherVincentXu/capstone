import MLAlgorithm as ml
import numpy as np
import readData as rd
from sklearn.naive_bayes import GaussianNB
from sklearn.model_selection import train_test_split
from sklearn.metrics import classification_report
from sklearn.ensemble import RandomForestClassifier
import pandas as pd
import h5py as hd

class RandomForest(ml.MLAlgorithm):
    def __init__(self,testname='test',subtestname='RandomForest',filenames=['breast'],features=['all'],test_train_split=.20,n_estimators=100, max_depth=None,random_state=0):
        super().__init__(testname=testname,subtestname=subtestname,filenames=filenames,features=features,test_train_split=.20)
        self.model = RandomForestClassifier(n_estimators=n_estimators, max_depth=max_depth,random_state=random_state)
        self.y_pred = []
        
    def run(self):        
        self.model.fit(self.X_train,self.y_train)
        self.y_pred = self.model.predict(self.X_test)
    
def main():
    RF = RandomForest()
    X,Y= RF.loadMatrixFromFile()
    RF.run()

if __name__ == '__main__':
    main()
