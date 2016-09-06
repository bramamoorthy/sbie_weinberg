# -*- coding: utf-8 -*-
#*************************************************************************
# Author: Je-Hoon Song, <song.jehoon@gmail.com>
# 
# This file is part of {sbie_weinberg}.
#*************************************************************************

import pandas as pd 
import pdb 
import json
import itertools 
from os.path import join,dirname

treatment_file = join(dirname(__file__), 'Demo_drug_response.csv')
output_dir = dirname(__file__)


def make_inputdata():

    df = pd.read_csv(treatment_file)

    celltypes = set(df['Primary Cell Line Name'])
    celltypes = [el.replace(' ', '') for el in celltypes]

    drugs = set(df['Compound'])
    drugs = [el for el in drugs]

    input_range = { 'cells': celltypes, 'drugs': drugs } 

    with open('input_range.json', 'w') as outfile: 
        json.dump(input_range, outfile, indent=4, sort_keys=True, \
            separators=(',',':'))

    combi_numbers = [1, 2]

    drugs_list = [] 

    for i in combi_numbers:
        for d in itertools.combinations(drugs, i):
            drugs_list.append(d)

    inputjson_list = [] 
    for thiscell in celltypes: 
        for drugmembers in drugs_list: 
            inputjson = {
                'input': {
                    'celltype': thiscell, 
                    'drugs': [el for el in drugmembers]
                    }
                }
            inputjson_list.append(inputjson)

    for i,inputjson in enumerate(inputjson_list):
        outputfilename = join(output_dir, 'demoinput_%d.json' % i)        
        with open(outputfilename, 'w') as outfile: 
            json.dump(inputjson, outfile, indent=4, sort_keys=True,
                separators=(',',':'))

            