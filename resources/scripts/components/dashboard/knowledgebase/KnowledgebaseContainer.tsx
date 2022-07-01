import React, {useEffect} from 'react';
import PageContentBlock from "@/components/elements/PageContentBlock";
import useFlash from "@/plugins/useFlash";
import useSWR from "swr";
import {categories, Category} from "@/api/knowledgebase";
import tw from "twin.macro";
import Spinner from "@/components/elements/Spinner";
import TitledGreyBox from "@/components/elements/TitledGreyBox";
import Button from "@/components/elements/Button";
import {NavLink} from "react-router-dom";
import MessageBox from "@/components/MessageBox";

const KnowledgebaseContainer = () => {
    const { clearFlashes, clearAndAddHttpError } = useFlash();
    const { data, error } = useSWR('/knowledgebase/categories', () => categories());

    useEffect(() => {
        if (!error) clearFlashes('knowledgebase'); else clearAndAddHttpError({ key: 'knowledgebase', error })
    });

    return (
        <PageContentBlock title={'Knowledgebase'} showFlashKey={'knowledgebase'}>
            {!data ?
                <div css={tw`w-full`}>
                    <Spinner size={'large'} centered/>
                </div>
                :
                <>
                    {!data.length ?
                        <MessageBox type={'info'} title={'Info'}>
                            There are no categories.
                        </MessageBox>
                        :
                        <div css={tw`w-full flex flex-wrap justify-evenly md:justify-between`}>
                            {data.map((category: Category) => (
                                <TitledGreyBox title={category.name} css={tw`w-9/12 md:w-5/12 lg:w-[30%] mb-6`}>
                                    <div css={tw`h-16 whitespace-normal text-sm`}>
                                        <p dangerouslySetInnerHTML={{ __html: category.description }}/>
                                    </div>
                                    <NavLink to={`/knowledgebase/list/${category.id}`} css={tw`flex justify-end`}>
                                        <Button size={'xsmall'} color={'primary'}>View</Button>
                                    </NavLink>
                                </TitledGreyBox>
                            ))}
                        </div>

                    }
                </>
            }
        </PageContentBlock>
    )
};

export default KnowledgebaseContainer;