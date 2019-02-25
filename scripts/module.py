#!/usr/bin/python3 -u

import sys
import subprocess

if __name__ == '__main__':
    if len(sys.argv) > 1:
        try:
            if sys.argv[1]:
                n = int(sys.argv[1])
            else:
                n = 25

            print("*" * 80)
            print("Begin " + "module.py")
            print("*" * 80)
            for i in range(n):
                print(i)
            print("*" * 80)
            print("End " + "module.py")
            print("*" * 80)

        except:
            print("*" * 80)
            print("*" + " "*31 + "Begin module.py" + " "*32 + "*")
            print("*" * 80)

            # print()
            # print(sys.argv)
            # print()

            sys.stdout.flush()

            subprocess.call(["cat", sys.argv[1]], stderr=sys.stdout.buffer)

            print("*" * 80)
            print("*" + " "*33 + "End module.py" + " "*32 + "*")
            print("*" * 80)
    else:
        print("No args specified")
