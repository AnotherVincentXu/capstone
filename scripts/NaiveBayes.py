import MLAlgorithm as ml
import numpy as np
import readData as rd
from sklearn.naive_bayes import GaussianNB
from sklearn.model_selection import train_test_split
from sklearn.metrics import classification_report
from sklearn.ensemble import RandomForestClassifier
import pandas as pd
import h5py as hd
import Results as results

class NaiveBayes(ml.MLAlgorithm):
    def __init__(self,testname='test',subtestname='subtest',filenames=['breast'],features=['all'],test_train_split=.20):
        super().__init__(testname=testname,subtestname=subtestname,filenames=filenames,features=features,test_train_split=.20)
        self.model = GaussianNB()
        self.y_pred = []
        
    def run(self):
        self.model.fit(self.X_train,self.y_train)
        self.y_pred = self.model.predict(self.X_test)
    
def main():
    NB = NaiveBayes()
    X,Y= NB.loadMatrixFromFile()
    NB.run()
    results.getResults(NB)
if __name__ == '__main__':
    main()

