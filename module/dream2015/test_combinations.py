from sbie_weinberg.module.dream2015 import combinations

def test(): 

    # scanner.divider('inp_part_', 'inp_part_list.csv', 1000) 

    output = combinations.generate() 
    output.to_csv('COMBINATIONS.csv')

    