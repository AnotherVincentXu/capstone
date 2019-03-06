import shutil as sh
import os as os
import numpy as np
import pandas as pd 
from sklearn.metrics import classification_report
import MLAlgorithm as ml
import RandomForest as rf
import NaiveBayes as nb
import NeuralNetwork as nn
import sklearn.metrics as skm

def getResults(model):
    model.saveModel()
    #y_pred = model.getY_pred()
    #y_test = model.getY_test()
    #np.savez(model.getPath()+'rawPredictionData.npz',y_pred = y_pred,y_test = y_test)
    cv = model.crossValidate()
    f = open(model.getPath() + 'results.txt','w')
    for k in cv.keys():
        res = cv[k]
        f.write('key: ' + str(k) + '\n' + ' std: ' + str(res.std()) + '\n' + ' mean: '+str(res.mean())+'\n')
    f.close()
