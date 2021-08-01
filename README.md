# Depression Analysis from Social Media Data in Bangla Language Applying Deep Recurrent Neural Networks
**Abstract**  
Human emotions like depression, sadness, happiness are inner sentiments of human beings which expose actual behaviors of a person. Analyzing and determining these types of emotions from people’s social activities in the virtual world can be very helpful to understand their behaviors. Existing approaches may be useful for analyzing common sentiments, such as positive, negative or neutral expressions. However, human emotions, such as depression, sadness, happiness are very critical and sometimes almost impossible to analyze using these approaches. In this work, we deployed Gated Recurrent Unit (GRU) and Long Short Term Memory (LSTM) Recurrent Neural Networks for depression analysis on Bangla social media data. We created a small dataset of Bangla tweets and stratifed it. In this research work, we have shown the eﬀects of hyper-parameters tuning and how these can be helpful for depression analysis on a small Bangla social media dataset. After hyperparameters tuning, we applied 10 folds cross-validation on the best-tuned model of GRU and LSTM. After training, we compared the results of GRU and LSTM implementations. The results show that GRU and LSTM can be applied on the small dataset with proper hyper-parameters tuning. The result also shows that, GRU models perform better than LSTM on a small dataset. This result will help psychologists and other researchers to detect depression of individuals from their social activities in the virtual world and help them to take necessary measures to prevent undesirable doings resulted from depression.


**Motivation**  
As social media are becoming more and more popular, people are expressingtheir emotions over these social media more and more. Depressed peopleare not out of this. They are becoming very vulnerable over time and cancommit any type of crimes, starting from suicide to killing others, out of theirdepression. If their social media interactions can be analyzed and cause oftheir depression can be detected, the government can take measures of thecauses of depression and take necessary steps to eradicate these causes.Technical details of depression analysis for textual data is rare in English andother languages, like Chinese. As far as we know, in Bangla, it is still to bedone. Considering these circumstances, we are motivated to do research inthis field. 


**Contributions**  
Depression analysis on text data is a very hard process, as it requires bothpsychological knowledge and semantic analysis of the text at the same time.In this thesis work, our main contributions are -  
*i. Technical Approach for Performing Depression Analysis in Bangla:* Existing works on depression analysis are mostly dependent on survey andstatistical methods. We performed depression analysis using most recenttechniques - GRU and LSTM.  
*ii. Creating Our Own Dataset with Original Bangla Text:* In this work, we have created our own Bangla dataset by collecting directly Bangla posts, none of the texts are translated from another language. Translat-ing texts from another language using machine translating software do notalways preserve actual formats of the language it is translated to. Hence,applying machine translated texts might create complexity while performingcomplex analyses tasks such as depression analysis. Also for the certainty oflabeling, we labeled our dataset by a student of Sociology.  
*iii. Developing an Algorithm for Pre-processing Bangla Data:* We have developed our own algorithm for pre-processing Bangla Data. Most ofthe software, tools or libraries available for data pre-processing are specifi-cally for English data only. Also, existing tools are hard to modify as neces-sary.  
*iv. Applying Deep Learning with Step by Step Hyper-parameters Tuning:* In this work, we have applied two of the most used Deep Learn-ing methods for text analysis in Bangla (Gated Recurrent Neural Networkand Long Short Term Memory Recurrent Neural Network) with step by stephyper-parameters tuning and have shown the effects of it.  
*v. Compare Deep Learning Methods on Bangla Data:* After applyingGRU and LSTM on Bangla data, we have performed step by step comparisonbetween the results of these Deep Learning methods.  


**Directories**  
*Data Collection Website: * https://github.com/abdulhasibuddin/My-Thesis-Works/tree/master/Data%20Labelling%20Website
*Data Cleaning Algorithm: * https://github.com/abdulhasibuddin/My-Thesis-Works/blob/master/Data%20Cleaning%20and%20MySQL%20Database.ipynb
*Depression Analysis with Long Short-term Memory (LSTM) on Balanced Dataset:* https://github.com/abdulhasibuddin/My-Thesis-Works/tree/master/Implementations
*Implementations with Stop Words in the Dataset:* https://github.com/abdulhasibuddin/My-Thesis-Works/tree/master/New%20Implementations
*Final Implementations (LSTM, GRU, Hyper-paramemter Tuning, 10-folds Cross-validation):* https://github.com/abdulhasibuddin/My-Thesis-Works/tree/master/GRU_vs_LSTM_FINAL


**Training**
*GRU Hyper-paramemter Tuning (Validation Accuracy vs. Iterations): * (https://github.com/abdulhasibuddin/My-Thesis-Works/blob/master/GRU_vs_LSTM_FINAL/images/gru_image_1_plotting%20_validation%20_accuracies%20_against%20_iterations.png)


**Thesis Link**
https://www.researchgate.net/publication/330635624_Depression_Analysis_from_Social_Media_Data_in_Bangla_Language_Applying_Deep_Recurrent_Neural_Networks


**Dataset**  
https://github.com/abdulhasibuddin/My-Thesis-Works/tree/master/Implementations
*Create .arff File for Weka Implementation:* https://github.com/abdulhasibuddin/My-Thesis-Works/blob/master/GRU_vs_LSTM_FINAL/Depression%20dataset%20arff%20file.ipynb


**Related Publications**  
1. **Uddin, Abdul Hasib**, Durjoy Bapery, and Abu Shamim Mohammad Arif. "Depression Analysis of Bangla Social Media Data using Gated Recurrent Neural Network." In 2019 1st International Conference on Advances in Science, Engineering and Robotics Technology (ICASERT), pp. 1-6. IEEE, 2019. DOI: 10.1109/ICASERT.2019.8934455  
2. **Uddin, Abdul Hasib**, Durjoy Bapery, and Abu Shamim Mohammad Arif. "Depression Analysis from Social Media Data in Bangla Language using Long Short Term Memory (LSTM) Recurrent Neural Network Technique." In 2019 International Conference on Computer, Communication, Chemical, Materials and Electronic Engineering (IC4ME2), pp. 1-4. IEEE, 2019. DOI: 10.1109/IC4ME247184.2019.9036528  
3. **Uddin, Abdul Hasib**, Sumit Kumar Dam, and Abu Shamim Mohammad Arif. "Extracting Severe Negative Sentence Pattern from Bangla Data via Long Short-term Memory Neural Network." In 2019 4th International Conference on Electrical Information and Communication Technology (EICT), pp. 1-6. IEEE, 2019. DOI: 10.1109/EICT48899.2019.9068794  
