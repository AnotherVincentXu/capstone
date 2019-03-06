import MLAlgorithm as ml
import numpy as np
import readData as rd
from sklearn.naive_bayes import GaussianNB
from sklearn.model_selection import train_test_split
from sklearn.metrics import classification_report
from sklearn.ensemble import RandomForestClassifier
import pandas as pd
import h5py as hd
from keras.models import Sequential
from keras.layers import Dense
from sklearn.model_selection import cross_validate
from keras.wrappers.scikit_learn import KerasClassifier
from sklearn.model_selection import StratifiedKFold


def create_model(HlayerSizes=[100,100],input_dim=0,activation = 'relu'):
        model = Sequential()
        model.add(Dense(HlayerSizes[0],input_dim=input_dim, activation=activation))
        for size in HlayerSizes[1:]:
            model.add(Dense(size, activation=activation))
            
        model.add(Dense(1, activation='sigmoid'))
        model.compile(loss='binary_crossentropy',
                      optimizer='rmsprop',
                      metrics=['accuracy'])
        return model
        
class NeuralNetwork(ml.MLAlgorithm):
        
    def __init__(self,testname='test',
                 subtestname='NeuralNetwork',
                 filenames=['breast'],
                 features=['all'],
                 test_train_split=.20,
                 nsplits=3,
                 HlayerSizes=[100,100]):
            
        super().__init__(testname=testname,
                         subtestname=subtestname,
                         filenames=filenames,
                         features=features,
                         test_train_split=.20)
        
        self.nsplits = nsplits
        self.HlayerSizes = HlayerSizes
   

    def run(self):
        
        self.y_pred = []
        self.model.fit(self.X_train,self.y_train)
        self.y_pred = self.model.predict(self.X_test)
        print(classification_report(self.y_test,self.y_pred))

    def loadMatrixFromFile(self):
        self.X = pd.read_hdf('NNlearningMatrix.h5')
        self.yTrue = pd.read_hdf('NNyTrue.h5')
        X_train, X_test, y_train, y_test = train_test_split(self.X, self.yTrue, test_size=self.ts, random_state=self.rs)
        self.X_train = X_train
        self.X_test = X_test
        self.y_train = y_train
        self.y_test = y_test
        self.model = KerasClassifier(build_fn=create_model,
                                     HlayerSizes=self.HlayerSizes,
                                     input_dim=self.X_train.shape[1],
                                     epochs=2,
                                     batch_size=128,
                                     verbose=True)
        return self.X,self.yTrue

    def run(self):
        self.model.fit(self.X_train, self.y_train)
        self.y_pred = self.model.predict(self.X_test)

    def crossValidate(self):
        kfold = StratifiedKFold(n_splits=self.nsplits,
                                shuffle=True,
                                random_state=self.rs)
        
        results = cross_validate(self.model,
                                 self.X,
                                 self.yTrue,
                                 cv=kfold,
                                 scoring=['f1_macro','precision_macro','recall_macro'],
                                 return_train_score=False)
        print('done: ',self.path)
        return results
    
    def getY_pred(self):
        return np.rint(self.y_pred)
    
def main():
    
    NN = NeuralNetwork()
    X,Y= NN.loadMatrixFromFile()
    NN.run()
    
if __name__ == '__main__':
    main()
