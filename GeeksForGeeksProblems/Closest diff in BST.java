// https://www.geeksforgeeks.org/find-closest-element-binary-search-tree/
// https://practice.geeksforgeeks.org/problems/find-the-closest-element-in-bst/

//This solution is for 2nd link, in JAVA since there is no PHP lang in GFG site
class Solution
{
    static int maxDiff(Node  root, int k)
    {
        if (root == null) {
            return 2140000000; //putting a very large value, in php it will be PHP_INT_MAX
        }
        if (root.data == k) {
            return 0;
        }

        int diff = Math.abs(root.data - k); // in php it will be abs()
        if (k < root.data) {
            return Math.min(diff, maxDiff(root.left, k)); // in php it will be min()
        }
        return Math.min(diff, maxDiff(root.right, k));
    }
}