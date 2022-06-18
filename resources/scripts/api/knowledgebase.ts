import http from '@/api/http';

export interface Category {
    id: number;
    name: string;
    description: string;
}

export interface Question {
    id: number;
    subject: string;
    information: string;
    author: string;
    updated_at: string;
    created_at: string;
}

export const categories = (): Promise<Category[]> => {
    return new Promise<Category[]>((resolve, reject) => {
        http.get('/api/client/knowledgebase/categories').then((data) => resolve(data.data || [])).catch(reject);
    });
};

export const questions = (id: number): Promise<Question[]> => {
    return new Promise<Question[]>((resolve, reject) => {
        http.get(`/api/client/knowledgebase/questions/${id}`).then((data) => resolve(data.data || [])).catch(reject);
    });
};

export const question = (id: number): Promise<Question> => {
    return new Promise<Question>((resolve, reject) => {
        http.get(`/api/client/knowledgebase/question/${id}`).then((data) => resolve(data.data || [])).catch(reject);
    });
};
