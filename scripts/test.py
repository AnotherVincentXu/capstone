#!/usr/bin/python3

import MLAlgorithm as ml
import RandomForest as rf
import NaiveBayes as nb 
import NeuralNetwork as nn
import Results as res
import sys, getopt

def main(argv):
   testname = ''

   HlayerSize = 100
   HlayerCount = 2

   nsplits = 3
   
   try:
      opts, args = getopt.getopt(argv,"hi:o:",["tname=","stname="])
   except getopt.GetoptError:
      print 'test.py -t <testname> -hls <Hidden Layer Size> -hlc <Hidden Layer Count> -n <nsplits>'
      sys.exit(2)
   for opt, arg in opts:
      if opt == '-h':
          print 'test.py -t <testname> -hls <Hidden Layer Size> -hlc <Hidden Layer Count> -n <nsplits>'
          sys.exit()
      elif opt in ("-t", "--tname"):
          testname = arg
      elif opt in ("-hls"):
          HlayerSize = arg
      elif opt in ("-hlc"):
          HlayerCount = arg
      elif opt in ("-n"):
          nsplits = arg

    Hlayer = [HlayerSize] * HlayerCount
          
    NB = nb.NaiveBayes(testname = testname,subtestname='naivebayes')
    X,Y= NB.loadMatrixFromFile()
    res.getResults(NB)

    RF = rf.RandomForest(testname=testname,subtestname='randomforest')
    X,Y = RF.loadMatrixFromFile()
    res.getResults(RF)

    NN = nn.NeuralNetwork(testname=testname,subtestname='neuralnetwork',HlayerSizes=Hlayer, nsplits=nsplits)
    X,Y = NN.loadMatrixFromFile()
    res.getResults(NN)
   
if __name__ == "__main__":
   main(sys.argv[1:])

   
