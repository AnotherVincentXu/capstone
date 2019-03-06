#!/usr/bin/python3

import numpy as np
import sklearn as sk
import pandas as pd
import string

# class for PreProcessing Data to be used by an MLAlgorithm    
class PreProcessor(object):
    # constructor - loads the raw data from files 
    def __init__(self,fnames,dummies=False,discretecutoff=10):
        self.fnames = fnames
        self.rawData = {}
        self.filedict = {}
        self.filedict['breast']=open('BREAST.TXT','r')
        self.filedict['colrect']= open('COLRECT.TXT','r')
        self.filedict['lymyleuk'] = open('LYMYLEUK.TXT','r')
        self.filedict['malegen']= open('MALEGEN.TXT','r')
        self.filedict['respir'] = open('RESPIR.TXT','r')
        self.filedict['urinary'] = open('URINARY.TXT','r')
        self.filedict['femgen'] = open('FEMGEN.TXT','r')
        self.allfnames = ['breast','colrect','lymyleuk','malegen','respir','urinary','femgen']
        self.dummies = dummies
        if fnames[0] == 'all':
            self.fnames = self.allfnames
            for name,f in self.filedict.items():
                self.rawData[name] = f.readlines()
            
        else:
            for name in fnames:
                if name not in self.allfnames:
                    print('FOUND INVALID FILENAME: ',name)
                    exit()
                self.rawData[name] = self.filedict[name].readlines()
                
        self.seerdictfile = open('seerdict.txt')
            
        self.dataPositionDict = {}
        self.featureList = []
        for line in self.seerdictfile:
            s = line.split(' ')
            start = [int(string) for string in s if string.isdigit()][0]-1
            s2 = [string for string in s if 'char' in string][0]
            length = int(''.join(list(filter(str.isdigit,s2))))
            end = start + length
            label = ''
            if s[6] != '':
                label = s[6]
            elif s[7] != '':
                label = s[7]
            elif s[8] != '':
                label = s[8]
            self.dataPositionDict[label]=(start,end)
            self.featureList.append(label)
            self.featsFinalUsed = []
            self.discretecutoff=discretecutoff
            
    def testSeerDict(self):
        for feature in self.featureList:
            print(feature + ': ' + str(self.dataPositionDict[feature]))
        print('length of first line of breast.txt: ' + str(len(self.rawData['breast'][0])))
        print('first line: ' + self.rawData['breast'][0])
  
    # returns a feature column of raw data    
    def getFeature(self,fname,feature):
        start,end = self.dataPositionDict[feature]
        return list(map(lambda x: x[start:end],self.rawData[fname]))

    def getTrainingExamples(self):
        featurePositions = list(self.dataPositionDict.values())
        mat = []
        for name in self.fnames:
            for line in self.rawData[name]:
                mat.append(list(map(lambda x: line[x[0]:x[1]],featurePositions)))
        return mat
        
    # returns name of all features
    def getAllFeatures(self):
        return self.featureList

    #returns incidentMatrix (training examples X features) in raw string form
    def getIncidentMatrix(self,listOfFeatureNames):
        incidentMatrixFeatures = []
        incidentMatrix = []
        index = 0
        for feature in listOfFeatureNames:
            L = []
            incidentMatrixFeatures.append(feature)
            for name in self.fnames:
                L = L + list(map(lambda x: x,self.getFeature(name,feature)))
            incidentMatrix.append(L)
            index += 1 
        mat = np.array(incidentMatrix)
        mat = mat.T
        return mat,incidentMatrixFeatures
        
    # finds column number of features which contain characters that will need to be encoded as integers 
    def getFeaturesToEncode(self,mat,features):
        L = []
        features = features
        for j in range(0,len(features)):
            x = False
            for item in mat[:,j]:
                for digit in item:
                    if digit != ' ' and not digit.isdigit():
                        x = True
                        L.append(j)
                        break
                if x:
                    break
        return L

    # encodes features in columns in list L
    def oneHotEncode(self,mat,L):
        columns = L
        for j in columns:
            strings = np.unique(mat[:,j]).tolist()
            newcolumn = np.array(list(map(lambda x: str(strings.index(x)),mat[:,j].tolist())))
            mat[:,j] = newcolumn
        return mat
    
  
    
    #fills matrix with nan values where there are blank strings 
    def fillNanValues(self,mat):
        missingMask = np.isin(mat,list(map(lambda x: ' '*x,range(1,10))))
        mat[missingMask] = -1
        mat = mat.astype(float)
        mat[mat == -1] = np.nan
        return mat
            
  
    #discretizes continuous features 
    def discretize(self,df,numlabels,features):
        for f in features:
            df[f] = pd.qcut(df[f],numlabels,labels=False,duplicates='drop')
        return df

    #separates matrix into training matrix and test vector as well as removes bad features
    def saveMatrixToFile(self,featuresToUse):
        discretecutoff = self.discretecutoff
        mat,features = self.getIncidentMatrix(featuresToUse)
        L = self.getFeaturesToEncode(mat,features)
        mat = self.oneHotEncode(mat,L)
        mat = self.fillNanValues(mat)
        features = np.array(features)
        goodfeatsmask=np.count_nonzero(~np.isnan(mat),axis=0) != 0
        mat = mat[:,goodfeatsmask]
        badfeatures = features[~goodfeatsmask].tolist()
        features = features[goodfeatsmask]
        df = pd.DataFrame(data=mat,columns=features)
        df = df.fillna(df.median())
        featsToDis = ['AGE_DX','YR_BRTH','YEAR_DX','EOD10_SZ','EOD10_PE','EOD10_NE','EOD10_PN','SEQ_NUM','CSTUMSIZ','CSEXTEN']
        for f in featsToDis:
            if f in badfeatures:
                featsToDis.remove(f)
                
        df = df[df['SRV_TIME_MON'] != 9999.0]
        
        df = df[((df['STAT_REC'] == 1.0) & (df['SRV_TIME_MON'] >= 60.0)) | ((df['VSRTSADX'] == 1.0) & (df['SRV_TIME_MON'] < 60.0))]
        yTrue = df['SRV_TIME_MON'] > 60.0
        
        featsToDrop = ['PUBCSNUM','REG','EOD13','EOD2','EOD4','EOD13','EOD_CODE','HISTO2V','STAT_REC','CODPUBKM','VSRTSADX','SRV_TIME_MON','SRV_TIME_MON_FLAG','ODTHCLASS','CODPUB']
        for f in featsToDrop:
            if f in badfeatures:
                featsToDrop.remove(f)
       
        df = df.drop(columns=featsToDrop)
        df = self.discretize(df,discretecutoff,featsToDis)
        self.featsFinalUsed = list(df)
        # dummy features not fully supported yet
        if self.dummies:
            dfnew = pd.DataFrame()
            for f in self.featsFinalUsed:
                #df = pd.concat([df,pd.get_dummies(df[f], prefix=f)],axis=1)
                for elem in df[f].unique():
                    dfnew[str(elem)] = df[f] == elem
            dfnew.to_hdf('NNlearningMatrix.h5','data')
            yTrue.to_hdf('NNyTrue.h5','data')
        else:
            df.to_hdf('learningMatrix.h5','data')
            yTrue.to_hdf('yTrue.h5','data')
            
    #After bad features are removed, this function returns the features that are actually used
    def getFeatsFinalUsed(self):
        return self.featsFinalUsed

    def handleSpecialFeatures(self,df):
        df['MAR_STAT'][df['MAR_STAT'] == 9] = np.nan
        df['RACE1V'][df['RACE1V'] == 99] = np.nan
        df['AGE_DX'][df['AGE_DX'] == 999] = np.nan
        
        return df

    
def main():
    D = PreProcessor(['breast'],dummies=False)
    D.saveMatrixToFile(D.getAllFeatures())
    D = PreProcessor(['breast'],dummies=True)
    D.saveMatrixToFile(D.getAllFeatures())
    
if __name__ == '__main__':
    main()
