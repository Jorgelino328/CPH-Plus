export function useApi(url: string, options = {}): Promise<any>
{
    return $fetch('http://127.0.0.1:8000/api/' + url, options)
}
