# coding: utf-8 -*-

import pandas as pd
import os, time, sys

class UserCf:

    def __init__(self):
        self.file_path = '../data/data.csv'
        self._init_frame()

    def _init_frame(self):
        self.frame = pd.read_csv(self.file_path)

    @staticmethod
    def _cosine_sim(target_movies, movies):
        '''
        用户相似度 计算算法
        sim = (N(u) & N(v)) / (N(u) | N(v))
        Jaccard index, 使用Jaccard相似系数
        '''
        and2 = 0.0
        or2 = 0.0
        set_intersection = set(target_movies['KindID']) & set(movies['KindID'])
        set_union = set(target_movies['KindID']) | set(movies['KindID'])
        for id in set_intersection:
            and2 += min(float(target_movies[target_movies['KindID'] == id]['Rating']), float(movies[movies['KindID'] == id]['Rating']))
        for id in set_union:
            try:
                or2 += max(float(target_movies[target_movies['KindID'] == id]['Rating']),
                           float(movies[movies['KindID'] == id]['Rating']))
            except TypeError:
                or2 += 0.0
        if or2 == 0: return 0.0
        sim = and2/or2
        return sim

    def _get_top_n_users(self, target_user_id, top_n):
        '''
        计算用户相识度，返回最相似的几个用户
        '''
        target_kinds = self.frame[self.frame['UserID'] == target_user_id][['KindID', 'Rating']]
        other_users_id = [i for i in set(self.frame['UserID']) if i != target_user_id]
        # 这是每一个人的看到的文章的类别值
        other_kinds = [self.frame[self.frame['UserID'] == i][['KindID', 'Rating']] for i in other_users_id]
        sim_list = [self._cosine_sim(target_kinds, kind) for kind in other_kinds]
        # 组合用户id和文章类别 排序返回
        sim_list = sorted(zip(other_users_id, sim_list), key=lambda x: x[1], reverse=True)
        return sim_list[:top_n]

    def _get_candidates_items(self, target_user_id):

        target_user_kinds = set(self.frame[self.frame['UserID'] == target_user_id]['KindID'])
        other_user_kinds = set(self.frame[self.frame['UserID'] != target_user_id]['KindID'])
        # 这里针对文章访问数据 二者取并
        candidates_kinds = list(target_user_kinds | other_user_kinds)
        return candidates_kinds

    def _get_top_n_items(self, top_n_users, candidates_kinds, top_n):
        """
        计算每个候选种类对于用户的喜爱程度
        e.g. 兴趣程度 = sum(sim * normalize_rating)
        """
        top_n_user_data = [self.frame[self.frame['UserID'] == k] for k, _ in top_n_users]
        interest_list = []
        for kind_id in candidates_kinds:
            tmp = []
            for user_data in top_n_user_data:
                if kind_id in user_data['KindID'].values:
                    # p(u,i) = ∑ w(u,v)*r(v,i) 这里的r(v,i)使用 ∑{Rating|user==v}
                    tmp.append(user_data[user_data['KindID'] == kind_id]['Rating'].values[0]/user_data['Rating'].sum())
                else:
                    tmp.append(0.0)
            interest = sum([top_n_users[i][1] * tmp[i] for i in range(len(top_n_users))])
            interest_list.append((kind_id, interest))
        interest_list = sorted(interest_list, key=lambda x: x[1], reverse=True)
        return interest_list[:top_n]

    def calculate(self, target_user_id=1, top_n=3):
        """
        user-cf for movies recommendation.
        """
        # 最相似的top_n个用户
        top_n_users = self._get_top_n_users(target_user_id, top_n)
        # 候选的文章种类
        candidates_kinds = self._get_candidates_items(target_user_id)
        # 最相似的n个文章种类
        top_n_kinds = self._get_top_n_items(top_n_users, candidates_kinds, top_n)

        return top_n_kinds







        
def run():
    assert os.path.exists('../data/data.csv'), \
        '文件不存在，请检查文件是否存在.'
    start = time.time()
    # 传入用户名称 返回对该用户推荐的文章种类
    kinds = UserCf().calculate(target_user_id=int(sys.argv[1]))
    res = 0
    for kind in kinds:
        res = res*10+kind[0]
    print(res)






run()